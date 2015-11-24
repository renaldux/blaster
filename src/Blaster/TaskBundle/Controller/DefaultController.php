<?php

namespace Blaster\TaskBundle\Controller;

use Blaster\TaskBundle\Entity\Blaster;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction($name='John')
    {
        return new Response($this->getBlasterManager()->myTask());
    }


    private function getBlasterManager(){
        return $this->container->get('blaster_task.example');
    }
}
