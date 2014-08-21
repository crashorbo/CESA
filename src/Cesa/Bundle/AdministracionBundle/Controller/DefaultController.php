<?php

namespace Cesa\Bundle\AdministracionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $usuario = $this->get('security.context')->getToken()->getUser();
        return $this->render('AdministracionBundle:Default:index.html.twig', array(
            'usuario'   =>  $usuario
        ));
    }

    public function loginAction()
    {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();

        $error = $peticion->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        return $this->render('AdministracionBundle:Default:login.html.twig', array(
            'error' => $error
        ));
    }
}
