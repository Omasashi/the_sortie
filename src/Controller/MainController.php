<?php

namespace App\Controller;

use App\Entity\Sites;
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

        $sitesRepo=$this->getDoctrine()->getRepository(Sites::class);
        $sites= $sitesRepo->findAll();
        //$sitesForm = $this->createForm(SitesType::class,$sites);
        $user=$this->getUser();
        $date=date("d-m-Y");
        return $this->render("main/home.html.twig",['date'=>$date,'user'=>$user,'sites'=>$sites,]);
    }
}
