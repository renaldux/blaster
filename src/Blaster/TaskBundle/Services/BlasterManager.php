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
        $response = [];
        try {
            $blaster = new Blaster();
            $blaster->setEmail('simona@petraitis.lt');
            $errors = $this->validator->validate($blaster);

            if (count($errors) > 0) {
                $response['status'] = 'failed';
                $response['message'] = $errors;
            }
            $response['status'] = 'success';
            $response['message'] = 'all success';
        }catch (\Exception $e){
            $response['status'] = 'failed';
            $response['message'][] = $e->getMessage();
        }
        return $response;
    }
}