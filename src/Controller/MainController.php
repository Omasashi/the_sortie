<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/",name="home")
     */
    public function home()
    {$user=$this->getUser();
        $date=date("d-m-Y");
        return $this->render("main/home.html.twig",['date'=>$date,'user'=>$user]);
    }
    public  function test(){

}

}
