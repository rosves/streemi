<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthentificationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function Register(): Response
    {
        return $this->render('Authentification/register.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    #[Route('/reset', name: 'app_reset')]
    public function Reset(): Response
    {
        return $this->render('Authentification/reset.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function Login(): Response
    {
        return $this->render('Authentification/login.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    #[Route('/confirm', name: 'app_confirm')]
    public function Confirm(): Response
    {
        return $this->render('Authentification/confirm.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    #[Route('/forgot', name: 'app_forgot')]
    public function Forgot(): Response
    {
        return $this->render('Authentification/forgot.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }
}
