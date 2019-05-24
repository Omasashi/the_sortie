<?php

namespace App\Controller;

use App\Entity\Sites;
use App\Entity\Sorties;
use App\Form\SitesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/",name="home")
     */
    public function home()
    {
        $sites1 = new Sites();
        $sitesRepo = $this->getDoctrine()->getRepository(Sites::class);
        $sites = $sitesRepo->findAll();
        $user = $this->getUser();
        $sitesForm = $this->createForm(SitesType::class, $sites1);
        $date = date("d-m-Y");
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties = $sortieRepo->findAll();

        dump($sorties);
        return $this->render("main/home.html.twig", ['date' => $date, 'user' => $user, 'sites' => $sites, 'sitesForm' => $sitesForm, 'sorties' => $sorties]);
    }
}
