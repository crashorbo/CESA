<?php

namespace Cesa\Bundle\ClienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $usuario = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('TramiteBundle:Tramite')->findByCliente($usuario);
        return $this->render('ClienteBundle:Default:index.html.twig', array(
            'usuario'   =>  $usuario,
            'entities'    =>  $entities
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

        return $this->render('ClienteBundle:Default:login.html.twig', array(
            'error' => $error
        ));
    }
    public function verAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $this->get('security.context')->getToken()->getUser();

        $entity = $em->getRepository('TramiteBundle:Tramite')->findOneById($id);

        return $this->render('ClienteBundle:Default:ver.html.twig', array(
            'usuario'   =>  $usuario,
            'entity'    =>  $entity,

        ));
    }
}
