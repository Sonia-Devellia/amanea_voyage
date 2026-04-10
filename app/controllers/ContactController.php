<?php

// On déclare le namespace 
namespace App\Controllers;

// On importe le Model 
use App\Models\Message;

// ContactController gère le formulaire de contact.
class ContactController extends Controller
{
    // Le Model utilisé dans ce Controller
    private Message $messageModel;

    // Le constructeur instancie le Model dont on a besoin
    public function __construct()
    {
        $this->messageModel = new Message();
    }

    // Affiche le formulaire de contact
    public function index(): void
    {
        $this->render('public/contact');
    }


    // Traite l'envoi du formulaire de contact appelé quand le visiteur soumet le formulaire
    public function send(): void
    {
        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('contact');
            return;
        }

        // On récupère et nettoie les données du formulaire
        // trim() supprime les espaces en début et fin de chaîne
        // htmlspecialchars() protège contre les injections XSS
        // Les clés correspondent aux colonnes BDD ; les valeurs lisent les name HTML du formulaire
        $data = [
            'firstname'      => htmlspecialchars(trim($_POST['prenom']       ?? '')),
            'lastname'       => htmlspecialchars(trim($_POST['nom']          ?? '')),
            'email'          => htmlspecialchars(trim($_POST['email']        ?? '')),
            'phone'          => htmlspecialchars(trim($_POST['telephone']    ?? '')),
            'travel_type'    => htmlspecialchars(trim($_POST['type_voyage']  ?? '')),
            'destination'    => htmlspecialchars(trim($_POST['destination']  ?? '')),
            'duration'       => htmlspecialchars(trim($_POST['duree']        ?? '')),
            'budget'         => htmlspecialchars(trim($_POST['budget']       ?? '')),
            'travelers'      => htmlspecialchars(trim($_POST['nb_voyageurs'] ?? '')),
            'departure_date' => htmlspecialchars(trim($_POST['date_depart']  ?? '')),
            'project'        => htmlspecialchars(trim($_POST['message']      ?? '')),
        ];


        // Validation des champs obligatoires
        if (empty($data['firstname']) || empty($data['lastname']) || empty($data['email'])) {
            $this->render('public/contact', [
                'error' => 'Veuillez remplir tous les champs obligatoires.',
                'data'  => $data,
            ]);
            return;
        }

        // Validation du format de l'email
        // filter_var vérifie que l'email est bien au format email
        // On valide l'email avant encodage pour ne pas casser le format
        if (!filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL)) {
            $this->render('public/contact', [
                'error' => 'L\'adresse email n\'est pas valide.',
                'data'  => $data,
            ]);
            return;
        }

        // ---------------------------------------------------------------------
        // Validation de la longueur des champs
        // On évite que quelqu'un envoie des textes trop longs
        // ---------------------------------------------------------------------
        if (strlen($data['firstname']) > 100 || strlen($data['lastname']) > 100) {
            $this->render('public/contact', [
                'error' => 'Le prénom et le nom ne peuvent pas dépasser 100 caractères.',
                'data'  => $data,
            ]);
            return;
        }

        if (strlen($data['project']) > 2000) {
            $this->render('public/contact', [
                'error' => 'La description du projet ne peut pas dépasser 2000 caractères.',
                'data'  => $data,
            ]);
            return;
        }

        // ---------------------------------------------------------------------
        // Validation du téléphone si renseigné
        // preg_match vérifie que le téléphone contient chiffres, espaces, +, -, () pour les formats internationaux
        // ---------------------------------------------------------------------
        if (!empty($data['phone']) && !preg_match('/^\+?[0-9\s\-().]{7,20}$/', trim($_POST['telephone'] ?? ''))) {
            $this->render('public/contact', [
                'error' => 'Le numéro de téléphone n\'est pas valide.',
                'data'  => $data,
            ]);
            return;
        }

        if (empty($_POST['rgpd'])) {
            $this->render('public/contact', [
                'error' => 'Vous devez accepter la politique de confidentialité pour envoyer votre demande.',
            ]);
            return;
        }
        
        // ---------------------------------------------------------------------
        // Les vérifications sont passées,on enregistre le message en bdd
        // PDO avec paramètres nommés protège contre les injections SQL
        // ---------------------------------------------------------------------
        $success = $this->messageModel->create($data);

        if ($success) {
            $this->render('public/contact', [
                'success' => 'Votre message a bien été envoyé. Nous vous répondrons rapidement.',
            ]);
        } else {
            $this->render('public/contact', [
                'error' => 'Une erreur est survenue. Veuillez réessayer.',
                'data'  => $data,
            ]);
        }

        
    }
}
