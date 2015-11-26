<?php

namespace Blaster\TaskBundle\Controller;

use Blaster\TaskBundle\Entity\Blaster;
use Blaster\TaskBundle\Form\BlasterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package Blaster\TaskBundle\Controller
 */
class DefaultController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $blaster = new Blaster();
        $form = $this->createForm(new BlasterType(), $blaster, array('method'=>'POST'));
        $form->handleRequest($request);

        /* create event */
        $event = $this->container->get("blaster_task.newsletter_subscriber");
        $event->setBlaster($blaster);
        $dispacher = new EventDispatcher();
        $dispacher->addListener('subscribe_newsletter', array($event, 'subscribeNewsletter'));

        if($form->isValid()){
            /*dispatch event */
            $dispacher->dispatch('subscribe_newsletter', $event);
        }


        return $this->render('BlasterTaskBundle:Default:index.html.twig', [
                'form'       => $form->createView()
                ]);

    }

}
