<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function formulaire() : string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];

            //ajout erreurs
            $validate =true;
            if(empty($_POST['firstname'])){
                $erreur_firstname = "Veuillez indiquer votre prénom.";
                $validate = false;
            }

            if (empty($_POST['lastname'])){
                $erreur_lastname = "Veuillez indiquer votre nom.";
                $validate = false;
            }

            if(empty($_POST['email'])){
                $erreur_email = "Veuillez indiquer votre email .";
                $validate = false;
            }elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                    $erreur_email = "Adresse Email non valide !";
                    $validate = false;
                }

            if(empty($_POST['comment'])){
                $erreur_comment = "Veuillez entrer votre message";
                $validate = false;
            }elseif(strlen($_POST['comment']) < 5){
                $erreur_comment = "Le message doit contenir plus de 5 caractères.";
                $validate = false;
            }

            // fin messages erreurs
            

            $manager = new ContactManager();
            $manager->insert($firstname, $lastname, $email, $comment);
            header('Location:/Contact/list');
        }
        return $this->twig->render('Contact/form.html.twig');
    }

    public function list() : string
    {
        $contacts = (new ContactManager())->selectAll();

        /*
        équivalent à 
        $manager = new ContactManager();
        $contacts = $manager->selectAll();*/

        return $this->twig->render('Contact/list.html.twig', [
            'contacts' => $contacts
        ]);
    }

    public function delete(int $id) : void 
    {
        $manager = new ContactManager();
        $manager->delete($id);
        header('Location:/Contact/list');
    }
}