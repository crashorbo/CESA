<?php

namespace Cesa\Bundle\AdministracionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Cesa\Bundle\ClienteBundle\Entity\Cliente;
use Cesa\Bundle\AdministracionBundle\Model\ClienteModel;
use Cesa\Bundle\AdministracionBundle\Form\ClienteModelType;


class ClienteController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:Cliente')->findAll();

        $usuario = $this->get('security.context')->getToken()->getUser();

        return $this->render('AdministracionBundle:Cliente:index.html.twig', array(
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
            $em = $this->getDoctrine()->getManager();
            $persona = $em->getRepository('ClienteBundle:Cliente')->findOneByNumeroDocumento($entity->numeroDocumento);
            if ($persona == null)
            {
                $cliente = new Cliente();
                $cliente->setNombres($entity->nombres);
                $cliente->setApellidoPaterno($entity->apellidoPaterno);
                $cliente->setApellidoMaterno($entity->apellidoMaterno);
                $cliente->setTipoDocumento($entity->tipoDocumento);
                $cliente->setNumeroDocumento($entity->numeroDocumento);
                $cliente->setEmail($entity->email);
                $cliente->setTelefono($entity->telefono);
                $cliente->setCelular($entity->celular);
                $cliente->setUsername($entity->numeroDocumento);
                $cliente->setSalt(md5(time()));
                $encoder = $this->get('security.encoder_factory')->getEncoder($cliente);
                $passwordCodificado = $encoder->encodePassword(
                    $cliente->getUsername(),
                    $cliente->getSalt()
                );
                $cliente->setPassword($passwordCodificado);


                $em->persist($cliente);
                $em->flush();
                return $this->redirect($this->generateUrl('empleado_cliente_home'));
                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('smtc_warning', 'Se ha Registrado al Cliente Con Exito');
            }
            else{
                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('smtc_warning', 'El Cliente ya esta Registrado');
            }

        }

        return $this->render('AdministracionBundle:Cliente:nuevo.html.twig', array(
            'usuario'  => $usuario,
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
}