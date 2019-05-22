<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Entity\Sites;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends Controller
{
    /**
     * @Route("/sortie", name="sortie")
     */
    public function index()
    {
        return $this->render('sortie/home.html.twig', [
            'controller_name' => 'SortieController'
        ]);
    }


}
