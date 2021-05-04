<?php

namespace App\Controller;

use App\Model\CommandManager;
use Exception;
use App\Model\ContactExtractManager;

class AdminController extends AbstractController
{
    public function admin()
    {
        $users = [];
        $contactExtrManager = new ContactExtractManager();
        $persons = $contactExtrManager->selectAll();

        $commandManager = new CommandManager();
        $commands = $commandManager->selectAll();


        $users = $commandManager->searchUser();
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']['role_id'] == 1) {
            return $this->customRender(
                'Admin/list.html.twig',
                ['persons' => $persons,
                 'commands' => $commands,
                    'users' => $users
                ]
            );
        } else {
            $this->errors = "Accès interdit aux utilisateurs non-admins ! Bien essayé petit malin !";
            return $this->customRender('Home/index.html.twig', ['errors' => $this->errors]);
        }
    }

    public function contacts()
    {
        //Les contacts
        $users = [];
        $contactExtrManager = new ContactExtractManager();
        $persons = $contactExtrManager->selectAll();

        $commandManager = new CommandManager();
        $commands = $commandManager->selectAll();


        $users = $commandManager->searchUser();
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']['role_id'] == 1) {
            return $this->customRender(
                'Admin/contacts.html.twig',
                ['persons' => $persons,
                    'commands' => $commands,
                    'users' => $users
                ]
            );
        }
    }

    public function commands()
    {
        //Les commandes
        $users = [];
        $contactExtrManager = new ContactExtractManager();
        $persons = $contactExtrManager->selectAll();

        $commandManager = new CommandManager();
        $commands = $commandManager->selectAll();


        $users = $commandManager->searchUser();
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']['role_id'] == 1) {
            return $this->customRender(
                'Admin/commands.html.twig',
                ['persons' => $persons,
                    'commands' => $commands,
                    'users' => $users
                ]
            );
        }
    }
}
