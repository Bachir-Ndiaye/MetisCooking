<?php

namespace App\Controller;

use App\Model\ContactExtractManager;

class ContactExtrController extends AbstractController
{

    public function list()
    {
        $contactExtrManager = new ContactExtractManager();
        $persons = $contactExtrManager->selectAll();

        return $this->twig->render('Contact/list.html.twig', ['persons' => $persons]);
    }
}
