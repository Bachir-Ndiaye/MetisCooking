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

        return $this->customRender('Menu/index.html.twig', [
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

        $dishManager = new DishManager();

        $entree = 'entree_id';
        $plat = 'plat_id';
        $dessert = 'dessert_id';

        //Url traitement
        $exploseUrl = (explode('/', $_SERVER['REQUEST_URI'])[3]);
        $format = rawurldecode($exploseUrl);

        //One single menu fetch
        $singleMenu = $dishManager->selectOneMenu($format);

        $entrees = $dishManager->selectOneDish(intval($singleMenu[$entree]));
        $plats = $dishManager->selectOneDish(intval($singleMenu[$plat]));
        $desserts = $dishManager->selectOneDish(intval($singleMenu[$dessert]));

        return $this->customRender('Menu/singlemenu.html.twig', [
            'menu' => $singleMenu,
            'entrees' => $entrees,
            'plats' => $plats,
            'desserts' => $desserts

        ]);
    }

    /**
     * Récuperer le menu a mettre dans la base de données
     */
    public function traitement()
    {
        $myCommands = [];
        $dishManager = new DishManager();

        //Url traitement
        $exploseUrl = (explode('/', $_SERVER['REQUEST_URI'])[3]);
        $format = rawurldecode($exploseUrl);

        //One single menu fetch
        $singleMenu = $dishManager->selectOneMenu($format);

        $_SESSION['command'][] = $singleMenu;
        $myCommands[] = $_SESSION['command'];

        $this->success = "Votre commande a bien été ajouté au panier !";

        return $this->customRender('Menu/command.html.twig', [
            'success' => $this->success,
            'mycommands' => $myCommands
        ]);
    }

    public function ajoutpanier()
    {
        $myCommands = [];
        $commandStatus = $_SESSION['command-status'];
        if (isset($_SESSION['command'])) {
            $myCommands = $_SESSION['command'];
        } else {
            $this->errors = "Votre panier est vide pour le moment !";
        }
        return $this->customRender('Menu/ajoutpanier.html.twig', [
            'mycommands' => $myCommands,
            'commandstatus' => $commandStatus,
            'errors' => $this->errors
        ]);
    }

    public function confirm()
    {

        //mettre la partie de suivie de commande dès lors que l'utilisateur appuis sur confirmer commande
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['confirm-command'])) {
                $this->success = "Votre commande est prise en compte. Merci pour votre confiance";
                $_SESSION['command-status'] = "Votre commande est entre de bonnes mains... Patience !";
                unset($_SESSION['command']);
                return $this->customRender('Home/index.html.twig', [
                    'success' => $this->success
                ]);
            }
        }
        header("Location : home/index");
    }

    public function delete(int $id)
    {
                unset($_SESSION['command'][$id]);
                $this->success = " Votre commande a été supprimé avec succès !";
                $_SESSION['command'] = array_values($_SESSION['command']);

            return $this->customRender('Home/index.html.twig', [
                'success' => $this->success
            ]);
    }
}
