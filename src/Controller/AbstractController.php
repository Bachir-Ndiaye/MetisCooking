<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 15:38
 * PHP version 7
 */

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    /**
     * @var Environment
     */
    protected Environment $twig;

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
       //If there is no session actif => create one and active it
        if (!isset($_SESSION)) {
            session_start();
        }

        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => !APP_DEV, // @phpstan-ignore-line
                'debug' => APP_DEV,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
    }

    public function destroySession()
    {
        session_destroy();
    }

    public function customRender(string $template, array $params): string
    {
        if (isset($_SESSION['current_user'])) {
            $params['current_user'] = $_SESSION['current_user'];
        }
        return $this->twig->render($template, $params);
    }
}
