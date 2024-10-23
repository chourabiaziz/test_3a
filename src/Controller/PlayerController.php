<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class PlayerController extends AbstractController
{
    #[Route('/player', name: 'app_player')]
    public function index(PlayerRepository $pr): Response
    {
        $players = $pr->findAll() ; 


        return $this->render('player/index.html.twig', [
             'players'=>$players
        ]);
    }


    #[Route('/player/add', name: 'app_player_add')]
    public function add(Request $request , EntityManagerInterface $em): Response
    {
            //creation d'un instance 
            $player = new Player ; 
        
            //création de formulaire 
            $form = $this->createForm(PlayerType::class , $player ) ;

            //analyse request et récuperation des données 
            $form->handleRequest($request) ;

            //traitement et envoyer des donnés lors de la "submit" de formulaire 
            if ($form->isSubmitted()) {

                $player->setCreatedat( new DateTime('now')) ; // current date affected to player.createdat
                $player->setAvaible(true); 

                $em->persist($player); // préparation des req 
                $em->flush() ; //exécution de les requétes 
                return $this->redirectToRoute('app_player'); // nom de route a redirecter 
            }



        return $this->render('player/add.html.twig', [
             'form'=> $form->createView()
        ]);
    }


    #[Route('/player/edit/{id}', name: 'app_player_aedit')]
    public function edit(Request $request ,int $id ,PlayerRepository $pr ,EntityManagerInterface $em): Response
    {
            //creation d'un instance 
            $player = $pr->find($id) ; 
        
            //création de formulaire 
            $form = $this->createForm(PlayerType::class , $player ) ;

            //analyse request et récuperation des données 
            $form->handleRequest($request) ;

            //traitement et envoyer des donnés lors de la "submit" de formulaire 
            if ($form->isSubmitted()) {
                $em->persist($player); // préparation des req 
                $em->flush() ; //exécution de les requétes 
                return $this->redirectToRoute('app_player'); // nom de route a redirecter 
            }



        return $this->render('player/edit.html.twig', [
             'form'=> $form->createView()
        ]);
    }


    #[Route('/player/delete/{id}', name: 'app_player_delete')]
    public function delete(int $id ,PlayerRepository $pr ,EntityManagerInterface $em): Response
    {
            //creation d'un instance 
            $player = $pr->find($id) ; 
          

           
            
                $em->remove($player); 
                $em->flush() ; //exécution de les requétes 
                return $this->redirectToRoute('app_player'); // nom de route a redirecter 
        

        
    }



    
}
