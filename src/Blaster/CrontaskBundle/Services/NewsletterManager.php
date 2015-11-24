<?php

namespace Blaster\CrontaskBuncle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class NewsletterManager
 * @package Blaster\CrontaskBuncle\Services
 */
class NewsletterManager
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