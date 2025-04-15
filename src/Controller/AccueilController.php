<?php

namespace App\Controller;

use App\Repository\MediaRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(MovieRepository $movie_repository): Response
    {

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController', 
        ]);
    }
}
