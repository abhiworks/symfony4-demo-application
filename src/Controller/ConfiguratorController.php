<?php
namespace App\Controller;
 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 

use App\Entity\ConfiguratorItems; 
use App\Form\Configurator;


  class ConfiguratorController  extends AbstractController
  {
    
    /**
     * Default Landing page
     * @Route("/configurator")
     */
    public function index()
    {
      $entityManager = $this->getDoctrine()->getRepository(ConfiguratorItems::class);
      $task = new ConfiguratorItems();  
      
      //Load form from \Form\Configurator
      $form = $this->createForm(Configurator::class, $task, array(
        'entity_manager' => $entityManager,
      ));

      return $this->render('configurator.html.twig', array(
        'form' => $form->createView(),
      )); 
          
    } 
  }

  
 ?>
