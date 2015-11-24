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

        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            dump($blaster);
            foreach($blaster->getCategories() as $cat){
                dump($cat);
            }
            exit;
            $em = $this->getDoctrine()->getManager();
            $em->persist($blaster);
            $em->flush();

        }
        return $this->render('BlasterTaskBundle:Default:index.html.twig', [
                'categories' => $this->getCategoryRepository()->findAll(),
                'form'       => $form->createView()

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
