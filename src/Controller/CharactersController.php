<?php

namespace App\Controller;

use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharactersController extends AbstractController
{
    #[Route('/characters', name: 'app_characters')]
    public function index(InertiaInterface $inertia): Response
    {
        return $inertia->render('Character');
    }
}
