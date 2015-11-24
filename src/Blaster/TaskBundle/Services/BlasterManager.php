<?php

namespace Blaster\TaskBundle\Services;

use Blaster\TaskBundle\Entity\Blaster;
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

    /**
     * BlasterManager constructor.
     * @param EntityManager $em
     * @param ValidatorInterface $validator
     */
    public function __construct(EntityManager $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }

    /**
     * @return string|void
     */
    public function myTask()
    {
        $respponse = [];

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