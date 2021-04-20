<?php

namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\DessertsManager;
use App\Model\EntreeManager;
use App\Model\MenuManager;
use App\Model\PlatsManager;

class MenuController extends AbstractController
{

    public function cookers(): string
    {
        /**
        * Get all data from entrees table
         */
        $entreesManager = new EntreeManager();
        $entrees = $entreesManager->selectAll('name');

        /**
         * Get all data from plats table
         */
        $platsManager = new PlatsManager();
        $plats = $platsManager->selectAll('name');

        /**
         * Get all data from desserts table
         */
        $dessertsManager = new DessertsManager();
        $desserts = $dessertsManager->selectAll('name');

        return $this->twig->render('Menu/index.html.twig', [
            'entrees' => $entrees,
            'plats' => $plats,
            'desserts' => $desserts
        ]);
    }

    public function singlemenu(): string
    {
        /**
         * Get all data from entrees table
         */
        $entreesManager = new EntreeManager();
        $entrees = $entreesManager->selectAll('name');

        /**
         * Get all data from plats table
         */
        $platsManager = new PlatsManager();
        $plats = $platsManager->selectAll('name');

        /**
         * Get all data from desserts table
         */
        $dessertsManager = new DessertsManager();
        $desserts = $dessertsManager->selectAll('name');
        return $this->twig->render('Menu/singlemenu.html.twig', [
            'entrees' => $entrees,
            'plats' => $plats,
            'desserts' => $desserts
        ]);
    }
}
