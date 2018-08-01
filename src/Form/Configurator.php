<?php
namespace App\Form;

use App\Entity\ConfiguratorItems;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 

class Configurator extends AbstractType
{
    /*
    Author : Abhijith 
    Desc: Function responsible for build form
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $entityManager = $options['entity_manager'];
        
         $fields_grouped = $entityManager  
                           ->getAllConfigs();  // Get Als configs from DB 

        foreach ( $fields_grouped as $key=>$fields) {
          $choice = array();$choice['conditions']  = '';

          // Iterate each field and arrange content like name, color n condtions
          foreach ( $fields as $field ) { 
           $choice['key'] = $key;
           $choice['selectType'] = $field['selectType'];
           $choice['data'][$field['name']] = $field['id']; 
            $choice['data-color'][$field['name']]['data-color'] = $field['color']; // storing color
           $choice['conditions'] .= ($field['conditions'] != '')? $field['id'] .'-'.$field['conditions'].';':'';           
        }
        
        $choice['conditions']  =  rtrim($choice['conditions'], ';');
        $data = $choice['data'];
        $data_attr = $choice['data-color'];
       
        $builder
          ->add('item_'.$field['configurator_item_id'], ChoiceType::class, 
            array(             
              'choices'   =>  $data , 
              'label'=> $choice['key'],
              'attr' => array('data-type' =>  $choice['selectType']),
              'choice_attr' =>  $data_attr, 
            ));
        if(isset($field['conditions']) && $field['conditions'] != '') { // Creating hidden values to store condirion
          $builder->add( 'hidden_item_'.$field['configurator_item_id'], HiddenType::class, array(
            'data' => $choice['conditions'],
          ));
        }
       
      }
      $builder->add('square', TextareaType::class, array(
        'attr' => array('class' => 'square_text'),
      ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setRequired('entity_manager');
    }


}

?>
