<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hackathon;
use App\Entity\Inscription;
use App\Entity\Utilisateurs;
use App\Form\RechercheHType;
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
        
        /*
        $form = $this->createForm(RechercheHType::class, $LesHackathons);
        if ($form->isSubmitted() && $form->isValid()) {
            $LesHackathons = $repo->findBy($form->getData());
        }
        */
        return $this->render('hackathon/listeH.html.twig', [
            /*"form" => $form->createView(),*/
            "lesHackathon" => $LesHackathons
        ]);

    }
    #[Route('/hackathon/{id}', name: 'app_hackathon_detail')]
    public function detail(ManagerRegistry $doctrine, $id): Response
    {
        /*$repoNbPlace = $doctrine->getRepository(Inscription::class);
        $lesInscrits = $repoNbPlace->findBy($id);
        $nbPlaceRestante = count($lesInscrits);*/
        

        $repo = $doctrine->getRepository(Hackathon::class);
        $LeHackathon = $repo->find($id);
        $lesInscriptions = count($LeHackathon->getLesInscriptions());

        $nbPlaceRestante = $LeHackathon->getNb_Place() - $lesInscriptions;

        //booléen nommé inscrit qui permet de savoir si l'utilisateur est inscrit ou non au hackathon
        if ($this->getUser()) {
            $repo2 = $doctrine->getRepository(Utilisateurs::class);
            $LeUser = $repo2->find($this->getUser()->getId());

            $repo3 = $doctrine->getRepository(Inscription::class);
            $Inscription = $repo3->findOneBy(['un_Hackathon' => $LeHackathon, 'un_Utilisateur' => $LeUser]);

            if ($Inscription) {
                $inscrit = true;
            } else {
                $inscrit = false;
            }
        } else {
            $inscrit = false;
        }
        

        return $this->render('hackathon/detailH.html.twig', [
            'leHackathon' => $LeHackathon,
            'nbPlaceRestante' => $nbPlaceRestante,
            'inscrit' => $inscrit
        ]);

    }

    #[Route('/inscription/{id}', name: 'app_hackathon_inscription')]
    public function inscription(ManagerRegistry $doctrine, $id): Response
    {
        $repo = $doctrine->getRepository(Hackathon::class);
        $LeHackathon = $repo->find($id);

        $repo2 = $doctrine->getRepository(Utilisateurs::class);
        $LeUser = $repo2->find($this->getUser()->getId());

        $inscription = new Inscription();
        $inscription->setUnHackathon($LeHackathon);
        $inscription->setUnUtilisateur($LeUser);
        $inscription->setDate(new \DateTime());

        $doctrine->getManager()->persist($inscription);
        $doctrine->getManager()->flush();

        $this->addFlash('success', 'Vous êtes inscrit au hackathon !');
        return $this->redirectToRoute('app_hackathon_detail', ['id' => $id]);
    }

    #[Route('/desinscription/{id}', name: 'app_hackathon_desinscription')]
    public function desinscription(ManagerRegistry $doctrine, $id): Response
    {
        $repo = $doctrine->getRepository(Hackathon::class);
        $LeHackathon = $repo->find($id);

        $repo2 = $doctrine->getRepository(Utilisateurs::class);
        $LeUser = $repo2->find($this->getUser()->getId());

        $repo3 = $doctrine->getRepository(Inscription::class);
        $Inscription = $repo3->findOneBy(['un_Hackathon' => $LeHackathon, 'un_Utilisateur' => $LeUser]);

        $doctrine->getManager()->remove($Inscription);
        $doctrine->getManager()->flush();

        $this->addFlash('success', 'Vous êtes désinscrit du hackathon !');
        return $this->redirectToRoute('app_hackathon_detail', ['id' => $id]);
    }
}
