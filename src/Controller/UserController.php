<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use ContainerHgEfX12\getUserRepositoryService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Masterminds\HTML5\Entities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class UserController extends AbstractController
{
    /**
     * Cette Function pour afficher la liste de Users
     *
     * @param UserRepository $repouser
     * @return Response
     */
    #[Route('/user', name:'app_user',methods:['GET'])]    
    public function index(UserRepository $repouser): Response
    {   
        return $this->render('pages/user/index.html.twig',[
            'users'=>$repouser->findAll()
        ]);
    }
    #[Route('user/create', name : 'create_user' , methods:['GET','POST'])]
    public function create(Request $request ,EntityManagerInterface $manager) : Response
    {
        $user =new User();
        $form= $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $users=$form->getData();
            $manager->persist($users);
            $manager->flush();
            return $this->redirectToRoute('app_user');
        }
        return $this->render('pages/user/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    #[Route('user/edit/{id}',name:'edit_user',methods:['GET','POST'])]
    public function edit(UserRepository $repo,
     int $id , 
     Request $request , 
     EntityManagerInterface $manager):Response
    {
        $user = $repo->findOneBy(["id"=>$id]);
        $form= $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $users=$form->getData();
            $manager->persist($users);
            $manager->flush();
            return $this->redirectToRoute('app_user');
        }
        
        return $this->render('pages/user/edit.html.twig',[
            "form" => $form->createView()
        ]);
    }
    #[Route('user/supprimer/{id}',name:'supprimer_user',methods:['GET','POST'])]
    public function supprimer(EntityManagerInterface $manager,
    User $user):Response{
        $manager->remove($user);
        $manager->flush();
        return $this->redirectToRoute('app_user');
    }
}
