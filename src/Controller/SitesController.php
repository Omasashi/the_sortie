<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SitesController extends Controller
{
    /**
     * @Route("/lieux", name="lieux")
     */
    public function lieux()
    {
        return $this->render('sites/lieux.html.twig', [
            'controller_name' => 'SitesController',
        ]);
    }
}
