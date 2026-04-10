<?php

// On déclare le namespace 
namespace App\Controllers;

// On importe les Models dont on a besoin
use App\Models\Type;
use App\Models\Destination;
use App\Models\Travel;

// VoyagesController gère la page Voyages & Expériences et les 4 pages de formules de voyage
class VoyagesController extends Controller
{
    // Les Models utilisés dans ce Controller
    private Type $typeModel;
    private Destination $destinationModel;
    private Travel $travelModel;

    // Le constructeur instancie les Models dont on a besoin
    public function __construct()
    {
        $this->typeModel        = new Type();
        $this->destinationModel = new Destination();
        $this->travelModel      = new Travel();
    }

    // -------------------------------------------------------------------------
    // Page principale Voyages & Expériences
    // Affiche les 4 formules de voyage et les destinations phares depuis la BDD
    // -------------------------------------------------------------------------
    public function index(): void
    {
        // On récupère toutes les formules avec leur image associée
        $types = $this->typeModel->findAllWithMedia();

        // On récupère uniquement les destinations phares (is_featured = 1)
        $destinations = $this->destinationModel->getFeatured();

        // On récupère les voyages publiés avec leurs étapes (depuis TRAVEL_STEP)
        $travels = $this->travelModel->getPublished();

        $this->render('public/voyages', [
            'types'        => $types,
            'destinations' => $destinations,
            'travels'      => $travels,
        ]);
    }


    // Page formule "En groupe"
    public function groupe(): void
    {
        // On récupère la formule par son slug
        $type = $this->typeModel->findBySlug('voyage-en-groupe');

        // On récupère la formule avec son image
        $typeWithMedia = $this->typeModel->findWithMedia($type['Id_TYPE']);

        $this->render('public/voyages/groupe', [
            'type' => $typeWithMedia,
        ]);
    }


    // Page formule "Au féminin"
    public function feminin(): void
    {
        $type          = $this->typeModel->findBySlug('voyage-au-feminin');
        $typeWithMedia = $this->typeModel->findWithMedia($type['Id_TYPE']);

        $this->render('public/voyages/feminin', [
            'type' => $typeWithMedia,
        ]);
    }


    // Page formule "De noces"
    public function noces(): void
    {
        $type          = $this->typeModel->findBySlug('voyage-de-noces');
        $typeWithMedia = $this->typeModel->findWithMedia($type['Id_TYPE']);

        $this->render('public/voyages/noces', [
            'type' => $typeWithMedia,
        ]);
    }


    // Page formule "Personnalisés"
    public function personnalises(): void
    {
        $type          = $this->typeModel->findBySlug('voyage-personnalise');
        $typeWithMedia = $this->typeModel->findWithMedia($type['Id_TYPE']);

        $this->render('public/voyages/personnalises', [
            'type' => $typeWithMedia,
        ]);
    }
}