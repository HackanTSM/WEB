<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hackathon;
use Doctrine\Persistence\ManagerRegistry;

class HackathonController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('hackathon/home.html.twig', []);
    }
    #[Route('/hackathon', name: 'app_hackathon')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Hackathon::class);
        $LesHackathons = $repo->findAll();
        return $this->render('hackathon/listeH.html.twig', [
            "lesHackathon" => $LesHackathons
        ]);

    }
}
