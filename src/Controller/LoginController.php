<?php

namespace App\Controller;

use App\Model\CommandManager;
use App\Model\LoginManager;

use function Amp\Iterator\filter;

class LoginController extends AbstractController
{
    public function destroy()
    {
        $this->destroySession();
        header("Location:/Home/index");
    }

    public function login(): string
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = array_map('trim', $_POST);
            $email = htmlentities($data['email']);
            $password = htmlentities($data['password']);
            if (empty($_POST['email'])) {
                $this->errors = "Veuillez indiquer votre email .";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors = "Adresse Email non valide";
            }
            if (empty($_POST['password'])) {
                $this->errors = "Veuillez indiquer votre mot de passe.";
            }

            if (empty($this->errors)) {
                $loginManager = new LoginManager();
                $user = $loginManager->verifLog($email, $password);
                if ($user === -1) {
                    $this->errors = " Identifiants incorrects ! Veuillez-vous inscrire";
                } else {
                    $this->success = "Vous êtes connecté";
                    $_SESSION['current_user'] = $user;

                    $commandManager = new CommandManager();
                    $commands = $commandManager->searchCommands($user['id']);
                    $dateCommand = '';

                    if ($commands != false) {
                        $dateCommand = (array_slice($commands, -1)[0]["created_at"]);
                    } else {
                        return $this->customRender('Home/index.html.twig', []);
                    }


                    $objectDateCommand = date_create($dateCommand);
                    $objectDateNow = date_create();

                    $dateDiff = date_diff($objectDateCommand, $objectDateNow);
                    $dateDiffFormated = intval($dateDiff->format('%d'));

                    if ($dateDiffFormated > 0) {
                        $this->errors = "Vous devez attendre demain pour commander ";
                        $_SESSION['can-command'] = 0;
                        return $this->customRender('Home/index.html.twig', [
                            'errors' => $this->errors
                        ]);
                    }

                    header('Location : home/index');
                        return $this->customRender('Home/index.html.twig', [
                            'success' => $this->success
                        ]);
                }
            }

            return $this->twig->render('Login/form.html.twig', [
                'errors' => $this->errors
            ]);
        }

        return $this->twig->render('Login/form.html.twig', [
            'errors' => $this->errors
        ]);
    }
}
