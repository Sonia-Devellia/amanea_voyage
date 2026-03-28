<?php

// On déclare le namespace 
namespace App\Controllers;

// On importe le Model dont on a besoin
use App\Models\Type;

// VoyagesController gère la page Voyages & Expériences et les 4 pages de formules de voyage
class VoyagesController extends Controller
{
    // Le Model utilisé dans ce Controller
    private Type $typeModel;

    // Le constructeur instancie le Model dont on a besoin
    public function __construct()
    {
        $this->typeModel = new Type();
    }

    // -------------------------------------------------------------------------
    // Page principale Voyages & Expériences
    // Affiche les 4 formules de voyage avec leurs images de couverture et de contenu
    // -------------------------------------------------------------------------
    public function index(): void
    {
        // On récupère toutes les formules avec leur image associée
        $types = $this->typeModel->findAllWithMedia();

        $this->render('public/voyages', [
            'types' => $types,
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