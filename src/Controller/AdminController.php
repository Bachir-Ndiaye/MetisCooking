<?php

namespace App\Controller;

use Exception;
use App\Model\ContactExtractManager;

class AdminController extends AbstractController
{
    public function admin()
    {
        $errors = [];
        $contactExtrManager = new ContactExtractManager();
        $persons = $contactExtrManager->selectAll();

        if (isset($_SESSION['current_user']) && $_SESSION['current_user']['role_id'] == 1) {
            return $this->customRender('Admin/list.html.twig', ['persons' => $persons]);
        } else {
            $errors = "Accès interdit aux utilisateurs non-admins ! Bien essayé petit malin !";
            return $this->customRender('Home/index.html.twig', ['errors' => $errors]);
        }
    }
}
