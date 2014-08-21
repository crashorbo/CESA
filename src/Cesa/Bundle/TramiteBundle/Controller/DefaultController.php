<?php

namespace Cesa\Bundle\TramiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TramiteBundle:Default:index.html.twig', array('name' => $name));
    }
}
