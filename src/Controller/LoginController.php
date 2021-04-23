<?php

namespace App\Controller;

use App\Model\LoginManager;

class LoginController extends AbstractController
{

    public function login(): string
    {
        $errors = [];
        $success = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty($_POST['email'])) {
                $errors[] = "Veuillez indiquer votre email .";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Adresse Email non valide";
            }
            if (empty($_POST['password'])) {
                $errors[] = "Veuillez indiquer votre mot de passe.";
            }

            if (empty($errors)) {
                if (isset($_POST['email']) && isset($_POST['password'])) {
                    $data = array_map('trim', $_POST);
                    $email = htmlentities($data['email']);
                    $password = htmlentities($data['password']);

                    $loginManager = new LoginManager();
                    $user = $loginManager->verifLog($email, $password);
                    if ($user !== -1) {
                        $success[] = "vous êtes inscrit";
                        return $this->twig->render('Home/index.html.twig');
                    }
                }
            }

            return $this->twig->render('Login/form.html.twig', [
                'errors' => $errors,
            ]);
        }

        return $this->twig->render('Login/form.html.twig', [
            'errors' => $errors,
        ]);
    }
}
