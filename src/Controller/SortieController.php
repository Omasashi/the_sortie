<?php

namespace App\Controller;

use App\Entity\Etats;
use App\Entity\Lieux;
use App\Entity\Sites;
use App\Entity\Sorties;
use App\Entity\Villes;
use App\Form\ModifierProfilType;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends Controller
{
    /**
     * @Route("/createSortie", name="createSortie")
     */
    public function createSortie(Request $request, EntityManagerInterface $em)
    {
        $sortie = new Sorties();
        $villeRepo = $this->getDoctrine()->getRepository(Villes::class);
        $villes = $villeRepo->findAll();
        $ville = $request->request->all();
        dump($ville);
        $user = $this->getUser();
        $site = $user->getSiteparticipant();
        $nomSite = $site->getNomSite();
        $sortie->setSortieSite($site);
        $sortie->setSortieParticipant($user);
        $sortie->setOrganisateur($user->getId());
        $etat = new Etats();

        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);
        if ($sortieForm->get('Enregistrer')->isClicked()) {
            $etatRepo = $this->getDoctrine()->getRepository(Etats::class);
            $etat = $etatRepo->find(3);
        } else {
            $etatRepo = $this->getDoctrine()->getRepository(Etats::class);
            $etat = $etatRepo->find(4);
        }
        $sortie->setEtatSortie($etat);
        $lieuForm = $this->createForm(SortieType::class, $sortie);
        $lieuForm->handleRequest($request);
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {

            $em->persist($sortie);
            $em->flush();
            $this->addFlash("success", "Modification réussie");
            return $this->redirectToRoute("home");
        }

        return $this->render('sortie/create_sortie.html.twig', ['user' => $user, 'villes' => $villes, "sortieForm" => $sortieForm->createView(), "site" => $nomSite]);
    }


    /**
     * @Route("/afficheSortie/{id}", name="afficheSortie")
     */
    public function afficheSortie($id, Request $request)
    {
        $sortie = new Sorties();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->find($id);
        $allSortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $allSortie = $allSortieRepo->findAll();


        dump($sortie);
        return $this->render('sortie/affiche_sortie.html.twig', ['sortie' => $sortie, 'allSortie' => $allSortie]);
    }

}
