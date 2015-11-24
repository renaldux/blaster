<?php

namespace Blaster\TaskBundle\Services;

use Blaster\TaskBundle\Entity\Blaster;
use Blaster\TaskBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class BlasterManager
 * @package Blaster\TaskBundle\Services
 */
class BlasterManager
{

    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var ValidatorInterface
     */
    private $validator;


    public function __construct(EntityManager $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }
    
    public function myTask()
    {
        $respponse = [];

        $category = new Category();
        $category->setName('naujienos');
        $this->em->persist($category);
        $this->em->flush();
        return;
        $blaster = new Blaster();
        $blaster->setEmail('simona@petraitis.lt');
        $blaster->addCategory();
        $errors = $this->validator->validate($blaster);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return '<pre>'.print_r($errorsString, true).'</pre>';
        }
        return 'all validated';
    }
}