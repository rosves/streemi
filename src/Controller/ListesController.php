<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListesController extends AbstractController
{
    #[Route('/listes', name: 'app_listes')]
    public function Listes(): Response
    {
        return $this->render('Series/Listes/lists.html.twig', [
            'controller_name' => 'ListesController',
        ]);
    }

    #[Route('/upload', name: 'app_upload')]
    public function Upload(): Response
    {
        return $this->render('Series/Listes/upload.html.twig', [
            'controller_name' => 'ListesController',
        ]);
    }
}
