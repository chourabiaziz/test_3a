<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('', name: 'app_home')] //route pour mettre dans l url  "/home"
    public function index(): Response // nom fonction avec le type de son retour 
    {
        $message  = " Chourabi aziz " ; 


        return $this->render('home/index.html.twig'
                    // tableau associative clé valeur 

                            , [ 
                                  // clé(a mentionner dans le vue ) => valeur 'affecté pour la vue 
                                    "msg" => $message


                                 ]
    ); // le retour  " vue => index.html.twig "
    }
}
