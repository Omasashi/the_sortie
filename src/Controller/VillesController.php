<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class VillesController extends Controller
{
    /**
     * @Route("/villes", name="villes")
     */
    public function villes()
    {
        return $this->render('villes/ville.html.twig', [
            'controller_name' => 'VillesController',
        ]);
    }
}
