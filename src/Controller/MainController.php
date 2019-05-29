<?php

namespace App\Controller;


use App\Entity\Sites;
use App\Entity\Sorties;
use App\Form\SitesType;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/",name="home")
     */
    public function home(Request $request, EntityManagerInterface $em)
    {
        $like = "";
        $organisateur = "";
        $etat = "";
        $inscrit = "";
        $pasInscrit="";
        $siterecherche="";
        $dateDebut="";
        $dateFin="";

        $rechercheSortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $recherche = $request->query->all();
        if (isset($recherche['organisateur']) && $recherche['organisateur'] == 'on') {
            $organisateur = $this->getUser()->getId();
        }
        if (isset($recherche['passees']) && $recherche['passees'] == 'on') {
            $etat = 2;
        }
        if (isset($recherche['like'])) {
            $like = $recherche['like'];
        }
        if (isset($recherche['inscrit'] ) && $recherche['inscrit']=="on") {
            $inscrit=$this->getUser()->getid();
        }
        if (isset($recherche['pasInscrit'] ) && $recherche['pasInscrit']=="on") {
            $pasInscrit=$this->getUser()->getid();
        }
        if (isset($recherche['site'] )) {
            $siterecherche=$recherche['site'];
        }
        if (isset($recherche['dateDebut'] ) && $recherche['dateDebut'] !="" && isset($recherche['dateFin'] )&& $recherche['dateFin']!="") {
            $dateDebut=$recherche['dateDebut'];
            $dateFin=$recherche['dateFin'];
        }
        $rechercheSortie = $rechercheSortieRepo->recherche($like, $organisateur, $etat,$inscrit,$pasInscrit,$siterecherche,$dateDebut,$dateFin);




        $recherche = $request->query->all();
        $sites1 = new Sites();
        $sitesRepo = $this->getDoctrine()->getRepository(Sites::class);
        $sites = $sitesRepo->findAll();
        $user = $this->getUser();
        $sitesForm = $this->createForm(SitesType::class, $sites1);
        $date = date("d-m-Y");
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->findAll();
        dump($sortie);

        return $this->render("main/home.html.twig", ['date' => $date, 'user' => $user, 'sites' => $sites, 'sitesForm' => $sitesForm, 'sorties' => $rechercheSortie]);
    }
}
