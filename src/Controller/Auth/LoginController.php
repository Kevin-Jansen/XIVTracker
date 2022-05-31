<?php

namespace App\Controller\Auth;

use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(InertiaInterface $inertia): Response
    {
        return $inertia->render('Auth/LoginPage', [
            'controller_name' => 'LoginController',
        ]);
    }
}
