<?php

namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\CommandManager;
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
        $status = $_SESSION['command-status'];
        $canCommand = $_SESSION['can-command'];
        return $this->customRender('Menu/index.html.twig', [
            'dish' => $dishes,
            'cooker' => $cookers,
            'menu' => $menus,
            'entrees' => $entrees,
            'plats' => $plats,
            'desserts' => $desserts,
            'status' => $status,
            'cancommand' => $canCommand
        ]);
    }


    public function singlemenu(string $menuName): string
    {
        $dishManager = new DishManager();

        $entree = 'entree_id';
        $plat = 'plat_id';
        $dessert = 'dessert_id';

        //One single menu fetch
        $singleMenu = $dishManager->selectOneMenu(rawurldecode($menuName));

        if ($singleMenu != false) {
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

        $this->errors = "Page not found 404";
        return $this->customRender('Redirect/index.html.twig', [
            'errors' => $this->errors
        ]);
    }

    /**
     * Récuperer le menu a mettre dans la base de données
     */
    public function traitement()
    {
        if (isset($_SESSION['current_user']) && ($_SESSION['can-command'] == 1)) {
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
        } elseif ($_SESSION['can-command'] == 0) {
            $this->errors = "Vous ne pouvez pas passer de commander avant demain ! ";
            return $this->customRender('Redirect/index.html.twig', [
                'errors' => $this->errors
            ]);
        } else {
            $this->errors = "Accès interdit ! Veuillez vous connecter ou vous inscrire";
            return $this->twig->render('Home/index.html.twig', [
                'errors' => $this->errors
            ]);
        }
    }

    public function ajoutpanier()
    {
        if (isset($_SESSION['current_user'])) {
            $myCommands = [];
            $total = 0;

            $commandStatus = $_SESSION['command-status'];
            if (isset($_SESSION['command'])) {
                $myCommands = $_SESSION['command'];
            } elseif (!(isset($_SESSION['command-status']))) {
                $this->errors = "Votre panier est vide pour le moment !";
            }

            foreach ($myCommands as $command) {
                $total += intval($command['price']);
            }

            $_SESSION['command-total'] = $total;

            $commandManager = new CommandManager();

            $commandPassed = $commandManager->searchCommands($_SESSION['current_user']['id']);


            return $this->customRender('Menu/ajoutpanier.html.twig', [
                'mycommands' => $myCommands,
                'commandstatus' => $commandStatus,
                'errors' => $this->errors,
                'total' => $total,
                'commandspassed' => $commandPassed
            ]);
        } else {
            $this->errors = "Accès interdit ! Veuillez vous connecter ou vous inscrire";
            return $this->twig->render('Home/index.html.twig', [
                'errors' => $this->errors
            ]);
        }
    }

    public function confirm()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['confirm-command'])) {
                $this->success = "Votre commande est prise en compte. Merci pour votre confiance";

                $commandNumber = $_SESSION['current_user']['id'] . "-" .
                    rand(1000, 10000) . "-" . $_SESSION['current_user']['lastname'];

                $_SESSION['command-status'] = "Votre commande " .
                    $commandNumber . " est entre de bonnes mains... Patience !";
                unset($_SESSION['command']);

                $commandManager = new CommandManager();
                $commandManager->insert(
                    $_SESSION['command-total'],
                    intval($_SESSION['current_user']['id']),
                    $commandNumber
                );

                return $this->customRender('Home/index.html.twig', [
                    'success' => $this->success
                ]);
            }
        } else {
            $this->errors = "Accès interdit ! Veuillez vous connecter ou vous inscrire";
            return $this->twig->render('Home/index.html.twig', [
                'errors' => $this->errors
            ]);
        }
    }

    public function delete(int $id)
    {
        if (isset($_SESSION['current_user'])) {
            unset($_SESSION['command'][$id]);
            $this->success = " Votre commande a été supprimé avec succès !";
            $_SESSION['command'] = array_values($_SESSION['command']);

            return $this->customRender('Home/index.html.twig', [
                'success' => $this->success
            ]);
        } else {
            $this->errors = "Accès interdit ! Veuillez vous connecter ou vous inscrire";
            return $this->twig->render('Home/index.html.twig', [
                'errors' => $this->errors
            ]);
        }
    }
}
