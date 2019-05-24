<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\Sites;
use App\Form\ModifierProfilType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
   
    /**
     * @Route("/user/profil", name="profil")
     */
    public function profil()//int $id, EntityManagerInterface $em
    {
        $sitesRepo=$this->getDoctrine()->getRepository(Sites::class);
        $sites= $sitesRepo->findAll();
        $user=$this->getUser();
        return $this->render('user/profil.html.twig', ['user'=>$user,'sites'=>$sites,]);
    }

    /**
     * @Route("/user/modifer_profil", name="modifier_profil")
     */
    public function modifierProfil(Request $request, EntityManagerInterface $em)
    {
        $sitesRepo=$this->getDoctrine()->getRepository(Sites::class);
        $sites= $sitesRepo->findAll();

        $user=$this->getUser();
        $modifierProfilForm = $this->createForm(ModifierProfilType::class, $user);
        $modifierProfilForm->handleRequest($request);
        if ($modifierProfilForm->isSubmitted()){
            $em->persist($user);
            $em->flush();
            $this->addFlash("success", "Modification réussie");
            return $this->redirectToRoute("profil");
        }

        return $this->render('user/modifier_profil.html.twig', ['user'=>$user,'sites'=>$sites,"modifierProfilForm" => $modifierProfilForm->createView()]);
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
