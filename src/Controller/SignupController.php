<?php

namespace App\Controller;

use App\Model\SignupManager;
use App\Model\LoginManager;

class SignupController extends AbstractController
{
    public function signup(): string
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = array_map('trim', $_POST);
            $firstname =  htmlentities($data['firstname']);
            $lastname = htmlentities($data['lastname']);
            $email = htmlentities($data['email']);
            $password = htmlentities($data['password']);

            if (!($this->isEmpty($data))) {
                $this->errors = "Tous les champs doivent être remplis";
            }
            if (empty($_POST['email'])) {
                $this->errors = "Veuillez indiquer votre email .";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors = "Adresse Email non valide";
            }


            if (empty($this->errors)) {
                $signupManager = new SignupManager();
                $result = $signupManager->insert($firstname, $lastname, $email, $password);
                if ($result == false) {
                    $this->errors = "Cet email est déjà utilisé";
                } else {
                    $this->success = "vous êtes inscrit";

                    $loginManager = new LoginManager();
                    $user = $loginManager->verifLog($email, $password);
                    $_SESSION['current_user'] = $user;
                    header('Location : home/index');

                        return $this->customRender('Home/index.html.twig', [
                            'success' => $this->success
                        ]);
                }
            }

            return $this->twig->render('Signup/form.html.twig', [
                'errors' => $this->errors
            ]);
        }

        return $this->twig->render('Signup/form.html.twig');
    }
}
