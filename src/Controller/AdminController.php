<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/add/film', name: 'app_add_film')]
    public function AddFilm(): Response
    {
        return $this->render('Admin/admin_add_films.html.twig', [
            'controller_name' => 'AddFilmController',
        ]);
    }

    #[Route('/film', name: 'app_film')]
    public function AdminFilm(): Response
    {
        return $this->render('Admin/admin_films.html.twig', [
            'controller_name' => 'AdminFilmController',
        ]);
    }

    #[Route('/users', name: 'app_users')]
    public function AdminUsers(): Response
    {
        return $this->render('Admin/admin_users.html.twig', [
            'controller_name' => 'AdminUsersController',
        ]);
    }

    #[Route('/admin_home', name: 'app_admin')]
    public function AdminHome(): Response
    {
        return $this->render('Admin/admin.html.twig', [
            'controller_name' => 'AdminHomeController',
        ]);
    }
}
