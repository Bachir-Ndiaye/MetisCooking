<?php

namespace App\Controller;

class MenuController extends AbstractController
{
    public function index(): string
    {

        return $this->twig->render('Menu/index.html.twig');
    }

    public function plats(): string
    {

        return $this->twig->render('Menu/plats.html.twig');
    }

    public function entrees(): string
    {

        return $this->twig->render('Menu/entrees.html.twig');
    }

    public function desserts(): string
    {

        return $this->twig->render('Menu/desserts.html.twig');
    }
}
