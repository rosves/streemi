<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SeriesController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function Category(): Response
    {
        return $this->render('Series/category.html.twig', [
            'controller_name' => 'SeriesController',
        ]);
    }

    #[Route('/detail_serie', name: 'app_detail_serie')]
    public function DetailSerie(): Response
    {
        return $this->render('Series/detail_serie.html.twig', [
            'controller_name' => 'SeriesController',
        ]);
    }

    #[Route('/detail', name: 'app_detail')]
    public function Detail(): Response
    {
        return $this->render('Series/detail.html.twig', [
            'controller_name' => 'SeriesController',
        ]);
    }

    #[Route('/discover', name: 'app_discover')]
    public function Discover(): Response
    {
        return $this->render('Series/discover.html.twig', [
            'controller_name' => 'SeriesController',
        ]);
    }
}
