<?php

namespace Cesa\Bundle\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Cesa\Bundle\BackendBundle\Model\EmpleadoModel;
use Cesa\Bundle\BackendBundle\Form\EmpleadoModelType;
use Cesa\Bundle\AdministracionBundle\Entity\Empleado;

class EmpleadoController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdministracionBundle:Empleado')->findAll();

        $usuario = $this->get('security.context')->getToken()->getUser();

        return $this->render('BackendBundle:Empleado:index.html.twig', array(
            'usuario'  => $usuario,
            'entities' => $entities
        ));
    }

    public function nuevoAction()
    {
        $peticion = $this->getRequest();
        $entity = new EmpleadoModel();
        $form = $this->createForm(new EmpleadoModelType(), $entity);

        $usuario = $this->get('security.context')->getToken()->getUser();

        $form->handleRequest($peticion);

        if ($form->isValid()) {
            $empleado = new Empleado();
            $empleado->setNombres($entity->nombres);
            $empleado->setApellidoPaterno($entity->apPaterno);
            $empleado->setApellidoMaterno($entity->apMaterno);
            $empleado->setCargo($entity->cargo);
            $empleado->setUsername($entity->username);
            $empleado->setSalt(md5(time()));
            $encoder = $this->get('security.encoder_factory')->getEncoder($empleado);
            $passwordCodificado = $encoder->encodePassword(
                $empleado->getUsername(),
                $empleado->getSalt()
            );
            $empleado->setPassword($passwordCodificado);

            $em = $this->getDoctrine()->getManager();
            $em->persist($empleado);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_empleado_home'));
        }

        return $this->render('BackendBundle:Empleado:nuevo.html.twig', array(
            'usuario'  => $usuario,
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    public function buscarAction()
    {
        $peticion = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmpleadoBundle:Cliente')->findByNumeroDocumento($peticion->get('busqueda'));

        return $this->render('BackendBundle:Cliente:buscarcliente.html.twig', array(
            'entities' => $entities
        ));
    }
}