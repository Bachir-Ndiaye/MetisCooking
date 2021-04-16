<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function formulaire(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];

            $manager = new ContactManager();
            $manager->insert($firstname, $lastname, $email, $comment);
            header('Location:/Contact/list');
        }
        return $this->twig->render('Contact/form.html.twig');
    }

    public function list(): string
    {
        $contacts = (new ContactManager())->selectAll();

        return $this->twig->render('Contact/list.html.twig', [
            'contacts' => $contacts
        ]);
    }

    public function delete(int $id): void
    {
        $manager = new ContactManager();
        $manager->delete($id);
        header('Location:/Contact/list');
    }
}
