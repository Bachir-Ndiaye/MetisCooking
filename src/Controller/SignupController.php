<?php

namespace App\Controller;

use App\Model\SignupManager;

class SignupController extends AbstractController
{
    public function signup(): string
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
            if (empty($_POST['password'])) {
                $errors[] = "Veuillez indiquer votre mot de passe.";
            }

            if (empty($errors)) {
                $success = " Vous êtes bien enregistré!";
                $data = array_map('trim', $_POST);
                $firstname =  htmlentities($data['firstname']);
                $lastname = htmlentities($data['lastname']);
                $email = htmlentities($data['email']);
                $password = htmlentities($data['password']);

                $signupManager = new SignupManager();
                $signupManager->insert($firstname, $lastname, $email, $password);
                return $this->twig->render('Home/index.html.twig', [
                    'success' => $success
                ]);
            }
        }

        return $this->twig->render('Signup/form.html.twig', [
            'errors' => $errors
        ]);
    }
}
