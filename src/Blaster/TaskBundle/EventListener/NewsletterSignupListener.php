<?php

namespace Blaster\TaskBundle\EventListener;

use Blaster\TaskBundle\Entity\Blaster;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class NewsletterSignupListener
 * @package Blaster\TaskBundle\EventListener
 */
class NewsletterSignupListener extends Event
{
    /**
     * @var Blaster
     */
    private $blaster;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var Logger
     */
    private $logger;

    /**
     * NewsletterSignupListener constructor.
     * @param EntityManagerInterface $em
     * @param ValidatorInterface $validator
     * @param Logger $logger
     */
    public function __construct(EntityManagerInterface $em,
                                ValidatorInterface $validator,
                                Logger $logger)
    {
        /*$this->blaster = $blaster;*/
        $this->em = $em;
        $this->validator = $validator;
        $this->logger = $logger;
    }

    public function subscribeNewsletter()
    {
        $errors = $this->validator->validate($this->blaster);
        if( count($errors)>0 ){
            //some errors found, log the errors
            $this->logger->addError( (string) $errors );
        }
        $this->em->persist($this->blaster);
        $this->em->flush();
    }

    /**
     * @param Blaster $blaster
     */
    public function setBlaster(Blaster $blaster)
    {
        $this->blaster = $blaster;
    }
}