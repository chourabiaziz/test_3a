<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipeController extends AbstractController
{
    #[Route('/equipe', name: 'app_equipe')]
    public function index(EquipeRepository $er): Response
    {
        $equipes = $er->findAll() ;


        return $this->render('equipe/index.html.twig', [
                'equipes'=>$equipes
        ]);
    }



    #[Route('/equipe/add', name: 'app_equipe_add')]
    public function add(Request $request , EntityManagerInterface $em): Response
    {
            //creation d'un instance 
            $equipe = new Equipe ; 
        
            //création de formulaire 
            $form = $this->createForm(EquipeType::class , $equipe ) ;

            //analyse request et récuperation des données 
            $form->handleRequest($request) ;

            //traitement et envoyer des donnés lors de la "submit" de formulaire 
            if ($form->isSubmitted()) {
                $em->persist($equipe); // préparation des req 
                $em->flush() ; //exécution de les requétes 
                return $this->redirectToRoute('app_equipe'); // nom de route a redirecter 
            }



        return $this->render('equipe/add.html.twig', [
             'form'=> $form->createView()
        ]);
    }


    #[Route('/equipe/edit/{id}', name: 'app_equipe_edit')]
    public function edit(Request $request ,int $id,EquipeRepository $er ,EntityManagerInterface $em): Response
    {
            //creation d'un instance 
            $equipe = $er->find($id) ; 
        
            //création de formulaire 
            $form = $this->createForm(EquipeType::class , $equipe ) ;

            //analyse request et récuperation des données 
            $form->handleRequest($request) ;

            //traitement et envoyer des donnés lors de la "submit" de formulaire 
            if ($form->isSubmitted()) {
                $em->persist($equipe); // préparation des req 
                $em->flush() ; //exécution de les requétes 
                return $this->redirectToRoute('app_equipe'); // nom de route a redirecter 
            }



        return $this->render('equipe/edit.html.twig', [
             'form'=> $form->createView()
        ]);
    }


    
    #[Route('/equipe/delete/{id}', name: 'app_equipe_delete')]
    public function delete( int $id,EquipeRepository $er ,EntityManagerInterface $em): Response
    {
            //creation d'un instance 
            $equipe = $er->find($id) ; 
        
            //création de formulaire 
          
                $em->remove($equipe); // préparation des req 
                $em->flush() ; //exécution de les requétes 
                return $this->redirectToRoute('app_equipe'); // nom de route a redirecter 
     


  
    }


    #[Route('/equipe/show/{id}', name: 'app_equipe_show')]
    public function show( int $id,EquipeRepository $er ,EntityManagerInterface $em): Response
    {
             $equipe = $er->find($id) ; 
        
           
              
            return $this->render("equipe/show.html.twig" , [
                'equipe' => $equipe 
            ]);
    }




}
