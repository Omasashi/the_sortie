<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/home.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * on nomme la route login car dans le fichier
     * security.yaml on a login_path: login
     * @Route("/login", name="login")
     */
    public function login(){
        return $this->render("user/login.html.twig",
            []);
    }

    /**
     * Symfony gére entierement cette route il suffit de l'appeler logout.
     * Penser à parametre le fichier security.yaml pour rediriger la déconnexion.
     * @Route("/logout", name="logout")
     */
    public function logout(){}

    /**
     * @Route("/userAdd",name="userAdd")
     */
    public function userAdd(EntityManagerInterface $em,Request $request){


$user = new Participants();
$user->setAdministrateur(false);
$user->setActif(true);
$userForm = $this->createForm(UserType::class,$user);

    //Récupération automatique des données du formulaire dans l'entité user
$userForm->handleRequest($request);
    //On vérifie que le formulaire est soumis et en plus qu'il est bien valide.
if($userForm->isSubmitted() && $userForm->isValid()){
$em->persist($user);
$em->flush();
    //synchronisation avec la BD et récupération dans $user de l'identifiant

$this->addFlash('success','The user has been saved !');
return $this->redirectToRoute("login",['id'=>$user->getId()]);
}
return $this->render('user/user_add.html.twig', ["userForm"=>$userForm->createView()]);
}

}
