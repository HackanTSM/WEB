<?php

namespace App\Controller;

use  App\Form\InscriptionType;
use App\Entity\Utilisateurs;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class UtilisateurController extends AbstractController
{
    #[Route('/connexionUtilisateur', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
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
    public function inscription(Request $request, ManagerRegistry $doctrine, AuthenticationUtils $authenticationUtils) : Response
    {
        $utilisateur = new Utilisateurs();
        $form=$this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $utilisateur->setSel("12345678901");
            $utilisateur->setRoles(["ROLE_USER"]);
            $entityManager=$doctrine->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            $lastUsername = $authenticationUtils->getLastUsername();
            return $this->render('utilisateur/connexionUtilisateur.html.twig', [
                'controller_name' => 'AdminController',
                'last_username' => $lastUsername,
            ]);
        }

        return $this->render('utilisateur/inscription.html.twig', [
            'controller_name' => 'UtilisateurController',
            'form' => $form -> createView(),
        ]);
    }


}
