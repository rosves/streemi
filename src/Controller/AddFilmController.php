<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddFilmController extends AbstractController
{
    #[Route('/add/film', name: 'app_add_film')]
    public function index(): Response
    {
        return $this->render('add_film/admin_add_films.html.twig', [
            'controller_name' => 'AddFilmController',
        ]);
    }
}
