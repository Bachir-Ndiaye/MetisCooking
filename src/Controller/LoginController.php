<?php

namespace App\Controller;

use App\Model\LoginManager;

use function Amp\Iterator\filter;

class LoginController extends AbstractController
{
    public function destroy()
    {
        $this->destroySession();
        $success = 'Vous êtes bien deconnecté';


        return $this->twig->render('Home/index.html.twig', [
            'session_destroy' => $success
        ]);
    }

    public function login(): string
    {
        $errors = [];
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = array_map('trim', $_POST);
            $email = htmlentities($data['email']);
            $password = htmlentities($data['password']);
            if (empty($_POST['email'])) {
                $errors[] = "Veuillez indiquer votre email .";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Adresse Email non valide";
            }
            if (empty($_POST['password'])) {
                $errors[] = "Veuillez indiquer votre mot de passe.";
            }

            if (empty($errors)) {
                $loginManager = new LoginManager();
                $user = $loginManager->verifLog($email, $password);
                if ($user === -1) {
                    $errors[] = "veuillez-vous inscrire";
                } else {
                    $success = "vous êtes connecté";


                    $_SESSION['current_user'] = $user;
                    header('Location : home/index');


                    return $this->customRender('Home/index.html.twig', [
                        'success' => $success
                        ]);
                }
            }

            return $this->twig->render('Login/form.html.twig', [
                'errors' => $errors
            ]);
        }

        return $this->twig->render('Login/form.html.twig', [
            'errors' => $errors
        ]);
    }
}
