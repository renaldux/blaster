<?php

namespace Blaster\TaskBundle\Controller;

use Blaster\TaskBundle\Entity\Blaster;
use Blaster\TaskBundle\Entity\CategoryRepository;
use Blaster\TaskBundle\Form\BlasterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $errors = [];
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {

        }
        return $this->render('BlasterTaskBundle:Default:index.html.twig', [
                'form'       => $form->createView(),
                'errors'     => $errors
            ]);

    }

    /**
     * @return \Blaster\TaskBundle\Services\BlasterManager
     */
    private function getBlasterManager(){
        return $this->container->get('blaster_task.blaster_manager');
    }

    /**
     * @return \Blaster\TaskBundle\Services\CategoryManager
     */
    private function getCategoryManager(){
        return $this->container->get('blaster_task.category_manager');
    }

    /**
     * @return CategoryRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private function getCategoryRepository(){
        return $this->getDoctrine()->getRepository('BlasterTaskBundle:Category');
    }

    /**
     * @return \Blaster\TaskBundle\Entity\BlasterRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private function getBlasterRepository(){
        return $this->getDoctrine()->getRepository('BlasterTaskBundle:Blaster');
    }
}
