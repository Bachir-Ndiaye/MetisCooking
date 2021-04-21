<?php

namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\CookersManager;
use App\Model\DishManager;
use App\Model\MenuManager;

class MenuController extends AbstractController
{

    public function cookers(): string
    {
        /**
         * Get all data from dishes table
         */
        $dishManager = new DishManager();
        $entree = 'entree_id';
        $plat = 'plat_id';
        $dessert = 'dessert_id';

        $dishes = $dishManager->selectAll();

        $entrees = $dishManager->selectDish($entree);
        $plats = $dishManager->selectDish($plat);
        $desserts = $dishManager->selectDish($dessert);

        /**
         * Get all data from cookers table
         */
        $cookerManager = new CookersManager();
        $cookers = $cookerManager->selectAll();

        /**
         * Get all data from menus table
         */
        $menuManager = new MenuManager();
        $menus = $menuManager->selectAll();

        return $this->twig->render('Menu/index.html.twig', [
         'dish' => $dishes,
         'cooker' => $cookers,
         'menu' => $menus,
         'entrees' => $entrees,
         'plats' => $plats,
         'desserts' => $desserts
        ]);
    }

    public function singlemenu(): string
    {
        return $this->twig->render('Menu/singlemenu.html.twig', [

        ]);
    }
}
