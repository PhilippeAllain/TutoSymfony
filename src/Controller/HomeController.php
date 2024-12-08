<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController {

    #[Route("/", name: "home")] /* Attribut Route puis le chemin '/'* et le nom de la route */
    function index(Request $request): Response { /* L'objet Request permet de récuper des informations */
        return $this->render('home/index.html.twig');
    }

}
