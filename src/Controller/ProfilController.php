<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/souscription', name: 'app_subscription')]
    public function index(): Response
    {
        return $this->render('Profil/subscriptions.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
}
