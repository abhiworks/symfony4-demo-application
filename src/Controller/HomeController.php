<?php
namespace App\Controller;
 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
 
  class HomeController  extends AbstractController
  {
    
    /**
     * Default Landing page
     * @Route("/home/index")
     */
    public function index()
    {
        return $this->render('home.html.twig', array( )); 
    }


  
  }

  
 ?>