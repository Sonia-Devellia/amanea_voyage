<?php

// On déclare le namespace 
namespace App\Controllers\Admin;

// On importe la classe parente et le Model
use App\Controllers\Controller;
use App\Models\Message;

// AdminMessageController gère les messages de contact reçus
// Nora peut consulter, traiter et répondre aux messages depuis le back-office
class AdminMessageController extends Controller
{
    // Le Model utilisé dans ce Controller
    private Message $messageModel;

    // Le constructeur instancie le Model dont on a besoin
    public function __construct()
    {
        $this->messageModel = new Message();
    }

    // -------------------------------------------------------------------------
    // Liste tous les messages
    // Les messages non lus sont affichés en premier
    // -------------------------------------------------------------------------
    public function index(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère les messages par statut pour les afficher séparément
        $unreadMessages    = $this->messageModel->findByStatus('non_lu');
        $readMessages      = $this->messageModel->findByStatus('lu');
        $answeredMessages  = $this->messageModel->findByStatus('repondu');

        $this->render('admin/messages/index', [
            'unreadMessages'   => $unreadMessages,
            'readMessages'     => $readMessages,
            'answeredMessages' => $answeredMessages,
        ]);
    }

    // -------------------------------------------------------------------------
    // Affiche le détail d'un message
    // Passe automatiquement le message en statut 'lu' à l'ouverture
    // -------------------------------------------------------------------------
    public function show(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère le message
        $message = $this->messageModel->findById($id);

        // Si le message n'existe pas on redirige vers la liste
        if (!$message) {
            $this->redirect('admin/messages');
            return;
        }

        // Si le message est encore non lu on le passe automatiquement en 'lu'
        if ($message['status'] === 'non_lu') {
            $this->messageModel->update($id, ['status' => 'lu']);
            // On assigne le message à l'admin connecté
            $this->messageModel->assignToAdmin($id, $_SESSION['admin']['id']);
        }

        $this->render('admin/messages/show', [
            'message' => $message,
        ]);
    }

    // -------------------------------------------------------------------------
    // Passe un message en statut 'repondu'
    // Appelé quand Nora a répondu au client par email ou téléphone
    // -------------------------------------------------------------------------
    public function markAnswered(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On met à jour le statut du message
        $this->messageModel->update($id, ['status' => 'repondu']);

        // On redirige vers la liste des messages
        $this->redirect('admin/messages');
    }

    // Supprime un message
    public function delete(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        $this->messageModel->delete($id);
        $this->redirect('admin/messages');
    }
}