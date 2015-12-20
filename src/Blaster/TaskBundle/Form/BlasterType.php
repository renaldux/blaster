<?php

namespace Blaster\TaskBundle\Form;

use Blaster\TaskBundle\Entity\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class BlasterType
 * @package Blaster\TaskBundle\Form
 */
class BlasterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('name')
            //->add('categories')
         ->add('categories', 'entity', array(
             'class' => 'Blaster\TaskBundle\Entity\Category',
             'query_builder' => function(CategoryRepository $cr) {
                 return $cr->createQueryBuilder('c')
                     ->orderBy('c.name', 'ASC');
            },
                'multiple'=>true
         ))
            ->add('save','submit', array('label'=>'save'))
//            ->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'checkEmail'])
        ;
    }

    private function checkEmail(FormEvent $event)
    {
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blaster\TaskBundle\Entity\Blaster'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blaster_taskbundle_blaster';
    }
}
