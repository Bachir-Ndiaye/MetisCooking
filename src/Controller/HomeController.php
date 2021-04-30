<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\HomeManager;

class HomeController extends AbstractController
{

    public function handlePostEmail(&$errors, &$success, $value): void
    {
        /**
             * Form to take email address for newsletter
             * */
                $email = trim($value);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == $email && !empty($email)) {
            $success = "Votre adresse e-mail a été bien enregistré.";
        }
        if (empty($email)) {
            $errors = "Le champ email ne peut pas être vide.";
        } else {
            $errors = "Adresse e-mail incorrect. Veuillez la re-saisir. ";
        }
    }
    public function handlePostPostalCode(&$errors, &$success, $value, $pCode): void
    {
            /**
             * Form to take postal code to locate user
             * */
                $postalcode = trim($value);
        if (preg_match($pCode, $postalcode)) {
            $success = "Un instant, nous recherchons nos cuisiniers les plus proche de chez vous";

            // if validation is ok, insert and redirection
            $homeManager = new HomeManager();
            $homeManager->insert($postalcode);
        }
        if (empty($postalcode)) {
            $errors = "Le champ code postal ne peut pas être vide.";
        }
        if (strlen($postalcode) > 5 || strlen($postalcode) < 5) {
            $errors = "Code postal invalide. Veuillez entrer 5 chiffres. ";
        } else {
            $errors = "Une erreur est survenue. Contactez l'admin à cet email : admin@metiscooking.fr ";
        }
    }


    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(): string
    {
        $email = '';
        $postalcode = '';
        $errors = [];
        $success = [];
        $postalCodePattern = '/^([0-9]{5})$/';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['submit'])) {
                $this->handlePostEmail($errors, $success, $_POST['email']);
            }

            if (isset($_POST['postcode'])) {
                $this->handlePostPostalCode($errors, $success, $_POST['postcode'], $postalCodePattern);
            }
        }

        return $this->customRender('Home/index.html.twig', [
            'email' => $email,
            'errors' => $errors,
            'success' => $success,
            'postalcode' => $postalcode
        ]);
    }
}
