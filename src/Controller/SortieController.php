<?php

namespace App\Controller;

use App\Entity\Etats;
use App\Entity\Inscriptions;
use App\Entity\Sorties;
use App\Entity\Villes;
use App\Form\AnnulerSortieType;
use App\Form\DesinscrirType;
use App\Form\InscriptionSortieType;
use App\Form\ModifierSortieType;
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


        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);


        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            if ($sortieForm->get('Enregistrer')->isClicked()) {
                $etatRepo = $this->getDoctrine()->getRepository(Etats::class);
                $etat = $etatRepo->findId(3);
                $sortie->setSortieEtat($etat);
                $em->persist($sortie);
                $em->flush();
                $this->addFlash("success", "Crétation réussie");
                return $this->redirectToRoute("home");
            } else {
                $etatRepo = $this->getDoctrine()->getRepository(Etats::class);
                $etat = $etatRepo->findId(4);
                $sortie->setSortieEtat($etat);
                $em->persist($sortie);
                $em->flush();
                $this->addFlash("success", "Crétation réussie");
                return $this->redirectToRoute("home");
            }


            $inscrit = new  Inscriptions();
//            $allSortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
//            $allSortie = $allSortieRepo->findAll();
//            $inscrit->addParitcipant($this->getUser());
//            $inscrit->setDateInscription(new \DateTime());
//            foreach (  $allSortie as $ti ){
//                if($ti->getOrganisateur()== $this->getUser()->getid()&& getSortieParticipant()!=){
//                    $inscrit->setSortie($ti);
//                }
//            }
//            $em->persist($inscrit);
//            $em->flush();


        }

        return $this->render('sortie/create_sortie.html.twig', ['user' => $user, 'villes' => $villes, "sortieForm" => $sortieForm->createView(), "site" => $nomSite]);
    }


    /**
     * @Route("/inscriptionSortie/{id}", name="inscriptionSortie")
     */
    public function inscriptionSortie($id, Request $request, EntityManagerInterface $em)
    {
        $sortie = new Sorties();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->find($id);

        $inscriptionSortieForm = $this->createForm(InscriptionSortieType::class, $sortie);
        $inscriptionSortieForm->handleRequest($request);
        $date = new \DateTime();
        dump($date);
        if ($inscriptionSortieForm->isSubmitted() && $inscriptionSortieForm->isValid()) {
            $inscrit = new Inscriptions();
            $inscrit->setSortie($sortie);
            $inscrit->setDateInscription($date);
            $inscrit->setParitcipant($this->getUser());
            $em->persist($inscrit);
            $em->flush();
            $this->addFlash("success", "Inscription réussie");
            return $this->redirectToRoute("home");
        }

        dump($sortie);
        return $this->render('sortie/inscription_sortie.html.twig', ["inscriptionSortieForm" => $inscriptionSortieForm->createView(), 'sortie' => $sortie]);
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

    /**
     * @Route("/desisterSortie/{id}", name="desisterSortie")
     */
    public function desisterSortie($id, Request $request,EntityManagerInterface $em)
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->find($id);
        $inscriptionSortieForm = $this->createForm(InscriptionSortieType::class, $sortie);
        $inscriptionSortieForm->handleRequest($request);

            if ($inscriptionSortieForm->isSubmitted() && $inscriptionSortieForm->isValid()){
            $instRepo = $this->getDoctrine()->getRepository(Inscriptions::class);
            $delete=$instRepo->findinscription($id,$this->getUser());
            dump($delete);
            $em->remove($delete);
            $em->flush();
            $this->addFlash("success", "Désinscription réussie");
            return $this->redirectToRoute("home");
        }

        return $this->render('sortie/desister_sortie.html.twig', ['sortie' => $sortie,'inscriptionSortieForm'=>$inscriptionSortieForm->createView()]);
    }

    /**
     * @Route("/annulerSortie/{id}", name="annuleSortie")
     */
    public function annuleSortie($id, Request $request, EntityManagerInterface $em)
    {
        $sortie = new Sorties();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->find($id);
        $allSortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $allSortie = $allSortieRepo->findAll();

        $annulerSortieForm = $this->createForm(AnnulerSortieType::class, $sortie);
        $annulerSortieForm->handleRequest($request);

        if ($annulerSortieForm->get('Enregistrer')->isClicked()) {
            $etatRepo = $this->getDoctrine()->getRepository(Etats::class);
            $etat = $etatRepo->find(3);
            $sortie->setSortieEtat($etat);
            if ($annulerSortieForm->isSubmitted() && $annulerSortieForm->isValid()) {

                $em->persist($sortie);
                $em->flush();
                $this->addFlash("success", "Annulation réussie");
                return $this->redirectToRoute("home");
            }
        }
        dump($sortie);
        return $this->render('sortie/annuler_sortie.html.twig', ['annulerSortieForm' => $annulerSortieForm->createView(), 'sortie' => $sortie, 'allSortie' => $allSortie]);
    }

    /**
     * @Route("/modifierSortie/{id}", name="modifieSortie")
     */
    public function modifierSortie($id, Request $request, EntityManagerInterface $em)
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
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->find($id);
        $etat = new Etats();

        $modifierSortieForm = $this->createForm(ModifierSortieType::class, $sortie);
        $modifierSortieForm->handleRequest($request);


        $lieuForm = $this->createForm(ModifierSortieType::class, $sortie);
        $lieuForm->handleRequest($request);

        if ($modifierSortieForm->get('Supprimer')->isClicked()) {
            $em->remove($sortie);
            $em->flush();
            $this->addFlash("success", "Supression réussie");
            return $this->redirectToRoute("home");
        }
        if ($modifierSortieForm->get('Enregistrer')->isClicked()) {
            $etatRepo = $this->getDoctrine()->getRepository(Etats::class);
            $etat = $etatRepo->find(3);
            $sortie->setSortieEtat($etat);
            if ($modifierSortieForm->isSubmitted() && $modifierSortieForm->isValid()) {

                $em->persist($sortie);
                $em->flush();
                $this->addFlash("success", "Modification réussie");
                return $this->redirectToRoute("home");
            }
        }
        if ($modifierSortieForm->get('Publier')->isClicked()) {
            $etatRepo = $this->getDoctrine()->getRepository(Etats::class);
            $etat = $etatRepo->find(4);
            $sortie->setSortieEtat($etat);
            if ($modifierSortieForm->isSubmitted() && $modifierSortieForm->isValid()) {

                $em->persist($sortie);
                $em->flush();
                $this->addFlash("success", "Modification réussie");
                return $this->redirectToRoute("home");
            }
        }

        return $this->render('sortie/modifier_sortie.html.twig', ['sortie' => $sortie, 'modifierSortieForm' => $modifierSortieForm->createView(), "site" => $nomSite, 'villes' => $villes]);
    }
}
