<?php

namespace Blaster\TaskBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CategoryManager
 * @package Blaster\TaskBundle\Services
 */
class CategoryManager
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
     * CategoryManager constructor.
     * @param EntityManager $em
     * @param ValidatorInterface $validator
     */
    public function __construct(EntityManager $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }

}