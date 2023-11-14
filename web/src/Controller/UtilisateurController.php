<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/connexionUtilisateur', name: 'app_utilisateur')]
    public function index(): Response
    {
        return $this->render('utilisateur/connexionUtilisateur.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
}
