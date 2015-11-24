<?php

namespace Blaster\TaskBundle\Form;

use Blaster\TaskBundle\Entity\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
                 return $cr->createQueryBuilder('c');
                 dump($cr->findAll());die;
            },

         ))
            ->add('save','submit', array('label'=>'isaugoti'))
        ;
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
