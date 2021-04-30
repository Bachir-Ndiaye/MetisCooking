<?php

namespace App\Controller;

use App\Model\SignupManager;
use App\Model\LoginManager;

class SignupController extends AbstractController
{
    public function signup(): string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = array_map('trim', $_POST);
            $firstname =  htmlentities($data['firstname']);
            $lastname = htmlentities($data['lastname']);
            $email = htmlentities($data['email']);
            $password = htmlentities($data['password']);

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
                $signupManager = new SignupManager();
                $result = $signupManager->insert($firstname, $lastname, $email, $password);
                if ($result == false) {
                    $errors[] = "Cet email est déjà utilisé";
                } else {
                    $success = "vous êtes inscrit";

                    $loginManager = new LoginManager();
                    $user = $loginManager->verifLog($email, $password);
                    $_SESSION['current_user'] = $user;
                    header('Location : home/index');

                        return $this->customRender('Home/index.html.twig', [
                            'success' => $success
                        ]);
                }
            }

            return $this->twig->render('Signup/form.html.twig', [
                'errors' => $errors
            ]);
        }

        return $this->twig->render('Signup/form.html.twig');
    }
}
