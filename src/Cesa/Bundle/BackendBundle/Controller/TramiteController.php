<?php

namespace Cesa\Bundle\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;

use Cesa\Bundle\BackendBundle\Form\TramiteModelType;
use Cesa\Bundle\BackendBundle\Model\TramiteModel;
use Cesa\Bundle\TramiteBundle\Entity\Tramite;
use Cesa\Bundle\AdministracionBundle\Entity\EmpleadoTramite;

class TramiteController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TramiteBundle:Tramite')->findAll();

        $usuario = $this->get('security.context')->getToken()->getUser();

        return $this->render('BackendBundle:Tramite:index.html.twig', array(
            'usuario'  => $usuario,
            'entities' => $entities
        ));
    }

    public function nuevoAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $usuario = $this ->get('security.context')->getToken()->getUser();


        $entity =  new TramiteModel();
        $form = $this->createForm(new TramiteModelType(), $entity);

        $form->handleRequest($peticion);

        if ($form->isValid())
        {
            $cliente = $em->getRepository('ClienteBundle:Cliente')->findOneByNumeroDocumento($entity->cliente);
            $empleado = $em->getRepository('AdministracionBundle:Empleado')->findOneByCargo('TRAMITADOR');
            $tramite = new Tramite();
            $tramite->setNumeroInterno($entity->numInterno);
            $tramite->setNumeroCarpeta($entity->numCarpeta);
            $tramite->setTipo($entity->tipo);
            $tramite->setCliente($cliente);
            $tramite->setPlaca($entity->placa);
            $tramite->setCanal($entity->canal);
            $tramite->setVista($entity->vista);
            $tramite->setAforo($entity->aforo);
            $tramite->setLevante($entity->levante);

            $em->persist($tramite);
            $em->flush();

            $et = new EmpleadoTramite();
            $et->setEmpleado($empleado);
            $et->setTramite($tramite);
            $em->persist($et);
            $em->flush();
        }

        return $this->render('BackendBundle:Tramite:nuevo.html.twig', array(
            'usuario'   =>  $usuario,
            'entity'    =>  $entity,
            'form' => $form->createView()
        ));
    }

    public function bclienteAction()
    {
        $peticion = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClienteBundle:Cliente')->findOneByNumeroDocumento($peticion->get('busqueda'));

        if ($entity != null)
        {
            $response = new Response(json_encode(array(
                'nombre'    => $entity->getNombres().' '.$entity->getApellidoPaterno().' '.$entity->getApellidoMaterno(),
                'documento' => $entity->getNumeroDocumento()
            )));
            $response->headers->set('Content-Type', 'application/json');
        }
        else{
            $response = new Response(json_encode(array(
                'nombre'    => null,
                'documento' => null
            )));
            $response->headers->set('Content-Type', 'application/json');
        }


        return $response;

    }
}