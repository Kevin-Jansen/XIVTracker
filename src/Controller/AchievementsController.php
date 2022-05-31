<?php

namespace App\Controller;

use App\Repository\AchievementRepository;
use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AchievementsController extends AbstractController
{
    private AchievementRepository $repo;

    public function __construct(AchievementRepository $achievementRepository) {
        $this->repo = $achievementRepository;
    }

    #[Route('/achievements', name: 'app_achievements')]
    public function index(InertiaInterface $inertia): Response
    {
        return $inertia->render('AchievementsPage', [
           'achievements' => $this->repo->findAll(),
        ]);
    }
}
