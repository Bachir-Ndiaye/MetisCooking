<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function formulaire(): string
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!($this->isEmpty($_POST))) {
                $this->errors = "Tous les champs doivent être remplis";
            }

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors = "Adresse Email non valide";
            }

            if (strlen($_POST['comment']) < 5) {
                $this->errors = "Le message doit contenir plus de 5 caractères .";
            }

            if (empty($this->errors)) {
                $this->success = "Merci pour votre message ! Il a bien été pris en compte.
                 Nous vous recontacterons rapidement.";

                $data = array_map('trim', $_POST);

                $firstname =  htmlentities($data['firstname']);
                $lastname = htmlentities($data['lastname']);
                $email = htmlentities($data['email']);
                $comment = htmlentities($data['comment']);

                $contactManager = new ContactManager();
                $contactManager->insert($firstname, $lastname, $email, $comment);
                return $this->customRender('Home/index.html.twig', [
                    'success' => $this->success
                ]);
            }
        }

        return $this->customRender('Contact/form.html.twig', [
            'errors' => $this->errors
        ]);
    }
}
