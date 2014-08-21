<?php

namespace Cesa\Bundle\BackendBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Cesa\Bundle\ClienteBundle\Entity\Cliente;
use Cesa\Bundle\BackendBundle\Model\ClienteModel;
use Cesa\Bundle\BackendBundle\Form\ClienteModelType;

use Cesa\Bundle\BackendBundle\Entity\Tramite;
use Cesa\Bundle\BackendBundle\Model\TramiteModel;
use Cesa\Bundle\BackendBundle\Form\TramiteModelType;

class ClienteController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:Cliente')->findAll();

        $usuario = $this->get('security.context')->getToken()->getUser();

        return $this->render('BackendBundle:Cliente:index.html.twig', array(
            'usuario'  => $usuario,
            'entities' => $entities
        ));
    }

    public function nuevoAction()
    {
        $peticion = $this->getRequest();
        $entity = new ClienteModel();
        $form = $this->createForm(new ClienteModelType(), $entity);

        $usuario = $this->get('security.context')->getToken()->getUser();

        $form->handleRequest($peticion);

        if ($form->isValid()) {
            $cliente = new Cliente();
            $cliente->setNombres($entity->nombres);
            $cliente->setApellidoPaterno($entity->apellidoPaterno);
            $cliente->setApellidoMaterno($entity->apellidoMaterno);
            $cliente->setTipoDocumento($entity->tipoDocumento);
            $cliente->setNumeroDocumento($entity->numeroDocumento);
            $cliente->setUsername($entity->numeroDocumento);
            $cliente->setTelefono($entity->telefono);
            $cliente->setCelular($entity->celular);
            $cliente->setSalt(md5(time()));
            $encoder = $this->get('security.encoder_factory')->getEncoder($cliente);
            $passwordCodificado = $encoder->encodePassword(
                $cliente->getUsername(),
                $cliente->getSalt()
            );
            $cliente->setPassword($passwordCodificado);

            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_cliente_home'));
        }

        return $this->render('BackendBundle:cliente:nuevo.html.twig', array(
            'usuario'  => $usuario,
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    public function buscarAction()
    {
        $peticion = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:Cliente')->findByNumeroDocumento($peticion->get('busqueda'));

        return $this->render('BackendBundle:Cliente:buscarcliente.html.twig', array(
            'entities' => $entities
        ));
    }
}