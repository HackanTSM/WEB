<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UtilisateurController extends AbstractController
{
    #[Route('/connexionUtilisateur', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('utilisateur/connexionUtilisateur.html.twig', [
            'controller_name' => 'UtilisateurController',
            'last_username' => $lastUsername,
        ]);
    }
    #[Route('/logout', name: 'app_utilisateur')]
    public function logout()
    {

    }
     #[Route('/inscription', name: 'app_inscription')]
    public function inscription()
    {
        return $this->render('utilisateur/inscription.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
}
