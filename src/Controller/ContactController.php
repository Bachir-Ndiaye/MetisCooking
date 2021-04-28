<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function formulaire(): string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty($_POST['firstname'])) {
                $errors[] = "Veuillez indiquer votre prénom.";
            }
            if (empty($_POST['lastname'])) {
                $errors[] = "Veuillez indiquer votre nom.";
            }

            if (empty($_POST['email'])) {
                $errors[] = "Veuillez indiquer votre email .";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Adresse Email non valide";
            }

            if (empty($_POST['comment'])) {
                $errors[] = "Veuillez entrer votre message";
            } elseif (strlen($_POST['comment']) < 5) {
                $errors[] = "Le message doit contenir plus de 5 caractères .";
            }

            if (empty($errors)) {
                $success = "Merci pour votre message ! Il a bien été pris en compte.
                 Nous vous recontacerons rapidement.";
                $data = array_map('trim', $_POST);
                $firstname =  htmlentities($data['firstname']);
                $lastname = htmlentities($data['lastname']);
                $email = htmlentities($data['email']);
                $comment = htmlentities($data['comment']);

                $contactManager = new ContactManager();
                $contactManager->insert($firstname, $lastname, $email, $comment);
                return $this->twig->render('Home/index.html.twig', [
                    'success' => $success
                ]);
            }
        }

        return $this->twig->render('Contact/form.html.twig', [
            'errors' => $errors
        ]);
    }
}
