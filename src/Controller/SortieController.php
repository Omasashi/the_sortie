<?php

namespace App\Controller;

use App\Entity\Sites;
use App\Entity\Sorties;
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
        $sitesRepo=$this->getDoctrine()->getRepository(Sites::class);
        $sites= $sitesRepo->findAll();

        $user=$this->getUser();
        $sortie=new Sorties();
        $sortie->setSortieParticipant($user);
        $sorieForm = $this->createForm(SortieType::class, $sortie);
        $sorieForm->handleRequest($request);
        if ($sorieForm->isSubmitted() && $sorieForm->isValid()){
            $em->persist($user);
            $em->flush();
            $this->addFlash("success", "Modification réussie");
            return $this->redirectToRoute("profil");
        }

        return $this->render('sortie/create_sortie.html.twig', ['user'=>$user,'sites'=>$sites,"sortieForm" => $sorieForm->createView()]);
    }

}
