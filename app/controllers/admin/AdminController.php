<?php

// On déclare le namespace 
namespace App\Controllers\Admin;

// On importe la classe parente et les Models dont on a besoin
use App\Controllers\Controller;
use App\Models\Message;
use App\Models\TravelProject;
use App\Models\User;
use App\Models\Article;
use App\Models\Notification;

// AdminController gère le tableau de bord et les paramètres du back-office
// C'est la première page que Nora voit après sa connexion
class AdminController extends Controller
{
    // Les Models utilisés dans ce Controller
    private Message $messageModel;
    private TravelProject $travelProjectModel;
    private User $userModel;
    private Article $articleModel;
    private Notification $notificationModel;

    // Le constructeur instancie les Models dont on a besoin
    public function __construct()
    {
        $this->messageModel       = new Message();
        $this->travelProjectModel = new TravelProject();
        $this->userModel          = new User();
        $this->articleModel       = new Article();
        $this->notificationModel  = new Notification();
    }

    // -------------------------------------------------------------------------
    // Tableau de bord admin
    // Première page après la connexion de Nora
    // Affiche un résumé de toute l'activité du site
    // -------------------------------------------------------------------------
    public function index(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère les messages non lus pour les afficher en priorité
        $unreadMessages = $this->messageModel->findByStatus('non_lu');

        // On récupère les projets en attente de traitement
        $pendingProjects = $this->travelProjectModel->findByStatus('en_attente');

        // On récupère le nombre total de clients
        $totalClients = $this->userModel->count();

        // On récupère les 5 derniers articles publiés
        $latestArticles = $this->articleModel->findPublished();
        $latestArticles = array_slice($latestArticles, 0, 5);

        // On récupère les notifications non lues
        // Ex : un client vient d'accepter les CGV et la Charte Amanéa
        $unreadNotifications = $this->notificationModel->findUnread();

        $this->render('admin/dashboard', [
            'unreadMessages'      => $unreadMessages,
            'pendingProjects'     => $pendingProjects,
            'totalClients'        => $totalClients,
            'latestArticles'      => $latestArticles,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

    // -------------------------------------------------------------------------
    // Marque une notification comme lue
    // Appelé quand Nora clique sur une notification
    // -------------------------------------------------------------------------
    public function markNotificationRead(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On marque la notification comme lue
        $this->notificationModel->markAsRead($id);

        // On redirige vers le dashboard
        $this->redirect('admin/dashboard');
    }


    // Marque toutes les notifications comme lues
    public function markAllNotificationsRead(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        $this->notificationModel->markAllAsRead();
        $this->redirect('admin/dashboard');
    }

    // -------------------------------------------------------------------------
    // Page statistiques
    // Donne à Nora une vue d'ensemble des performances du site
    // -------------------------------------------------------------------------
    public function stats(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // Nombre total de clients inscrits
        $totalClients = $this->userModel->count();

        // Nombre total d'articles publiés
        $totalArticles = $this->articleModel->count();

        // Nombre total de messages reçus
        $totalMessages = $this->messageModel->count();

        // Nombre de messages non lus
        $unreadMessages = count($this->messageModel->findByStatus('non_lu'));

        // Projets par statut — pour suivre le pipeline de voyages
        $projectsEnAttente = count($this->travelProjectModel->findByStatus('en_attente'));
        $projectsEnCours   = count($this->travelProjectModel->findByStatus('en_cours'));
        $projectsConfirmes = count($this->travelProjectModel->findByStatus('confirme'));
        $projectsTermines  = count($this->travelProjectModel->findByStatus('termine'));

        // ---------------------------------------------------------------------
        // Statistiques de visites
        // NOTE : Les statistiques de visites (pages vues, visiteurs uniques...)
        // nécessitent un outil externe comme Google Analytics ou Matomo.
        // Elles pourront être intégrées ici dans une évolution future du projet
        // via leur API respective.
        // ---------------------------------------------------------------------

        $this->render('admin/stats', [
            'totalClients'      => $totalClients,
            'totalArticles'     => $totalArticles,
            'totalMessages'     => $totalMessages,
            'unreadMessages'    => $unreadMessages,
            'projectsEnAttente' => $projectsEnAttente,
            'projectsEnCours'   => $projectsEnCours,
            'projectsConfirmes' => $projectsConfirmes,
            'projectsTermines'  => $projectsTermines,
        ]);
    }

    // -------------------------------------------------------------------------
    // Page paramètres
    // Permet à Nora de modifier les informations de son compte admin
    // -------------------------------------------------------------------------
    public function parametres(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        $this->render('admin/parametres');
    }
}