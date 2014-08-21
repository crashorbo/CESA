<?php

namespace Cesa\Bundle\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Cesa\Bundle\BackendBundle\Model\DocumentoModel;
use Cesa\Bundle\BackendBundle\Form\DocumentoModelType;
use Cesa\Bundle\TramiteBundle\Entity\Documento;

class DocumentoController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TramiteBundle:Documento')->findAll();

        $usuario = $this->get('security.context')->getToken()->getUser();

        return $this->render('BackendBundle:Documento:index.html.twig', array(
            'usuario'  => $usuario,
            'entities' => $entities
        ));
    }

    public function nuevoAction()
    {
        $peticion = $this->getRequest();
        $entity = new DocumentoModel();
        $form = $this->createForm(new DocumentoModelType(), $entity);

        $usuario = $this->get('security.context')->getToken()->getUser();

        $form->handleRequest($peticion);

        if ($form->isValid()) {
            $documento = new Documento();
            $documento->setCodigo($entity->codigo);
            $documento->setDescripcion($entity->descripcion);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($documento);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_documento_home'));
        }

        return $this->render('BackendBundle:documento:nuevo.html.twig', array(
            'usuario'  => $usuario,
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
}