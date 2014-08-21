<?php

namespace Cesa\Bundle\AdministracionBundle\Controller;

use Cesa\Bundle\TramiteBundle\Entity\Movimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Ps\PdfBundle\Annotation\Pdf;

use Cesa\Bundle\BackendBundle\Form\TramiteModelType;
use Cesa\Bundle\BackendBundle\Model\TramiteModel;
use Cesa\Bundle\TramiteBundle\Entity\Tramite;
use Cesa\Bundle\AdministracionBundle\Entity\EmpleadoTramite;
use Cesa\Bundle\AdministracionBundle\Model\DocumentoModel;
use Cesa\Bundle\AdministracionBundle\Form\DocumentoType;
use Cesa\Bundle\AdministracionBundle\Model\GastoModel;
use Cesa\Bundle\AdministracionBundle\Form\GastoType;
use Cesa\Bundle\AdministracionBundle\Form\EnvioType;
use Cesa\Bundle\AdministracionBundle\Model\EnvioModel;
use Cesa\Bundle\TramiteBundle\Entity\TramiteDocumento;

class TramiteController extends Controller{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $this->get('security.context')->getToken()->getUser();

        $entities = $em->getRepository('AdministracionBundle:EmpleadoTramite')->findTramites($usuario->getId());

        return $this->render('AdministracionBundle:Tramite:index.html.twig', array(
            'usuario'  => $usuario,
            'entities' => $entities
        ));
    }

    public function agregardocAction(Request $request, $id)
    {
        $documento = new DocumentoModel();
        $form = $this->createForm(new DocumentoType(), $documento);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $tramite = $em->getRepository('TramiteBundle:Tramite')->findOneById($id);
            $doc = $em->getRepository('TramiteBundle:Documento')->findOneById($documento->documento);
            $tramitedoc = new TramiteDocumento();
            $tramitedoc->setDocumento($doc);
            $tramitedoc->setTramite($tramite);
            $tramitedoc->setTipoDocumento($documento->tipoDocumento);
            $em->persist($tramitedoc);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('empleado_tramite_ver', array('tramite_id' => $id)));
    }

    public function agregargastoAction(Request $request, $id)
    {
        $gasto = new GastoModel();
        $form = $this->createForm(new GastoType(), $gasto);

        if($request->isMethod('POST'))
        {

            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $tramite = $em->getRepository('TramiteBundle:Tramite')->findOneById($id);
            $movimiento = new Movimiento();
            $movimiento->setTramite($tramite);
            $movimiento->setDetalle($gasto->detalle);
            $movimiento->setMonto($gasto->costo);
            $movimiento->setTipo('EGRESO');
            $em->persist($movimiento);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('empleado_tramite_ver', array('tramite_id' => $id)));
    }

    public function nuevoAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $usuario = $this ->get('security.context')->getToken()->getUser();

        $ni = 1;
        $tramites = $em->getRepository('TramiteBundle:Tramite')->findBy(array(), array('id' => 'DESC'));
        if($tramites != null)
        {
            $ni = $tramites[0]->getId();
        }

        $entity =  new TramiteModel();
        $entity->numInterno = 'cesa'.($ni+1);
        $form = $this->createForm(new TramiteModelType(), $entity);

        if($peticion->isMethod('POST'))
        {
            $form->handleRequest($peticion);

            if ($form->isValid())
            {
                $nc = $em->getRepository('TramiteBundle:Tramite')->findOneByNumeroCarpeta($entity->numCarpeta);
                if($nc == null)
                {
                    $cliente = $em->getRepository('ClienteBundle:Cliente')->findOneByNumeroDocumento($entity->cliente);
                    $tramite = new Tramite();
                    $tramite->setNumeroInterno('cesa'.($ni+1));
                    $tramite->setNumeroCarpeta($entity->numCarpeta);
                    $tramite->setTipo($entity->tipo);
                    $tramite->setCliente($cliente);
                    $tramite->setPlaca($entity->placa);

                    $em->persist($tramite);
                    $em->flush();

                    $et = new EmpleadoTramite();
                    $et->setEmpleado($usuario);
                    $et->setTramite($tramite);
                    $em->persist($et);
                    $em->flush();
                    return $this->redirect($this->generateUrl('empleado_tramite_ver', array('tramite_id' => $tramite->getId())));
                }
                else{
                    $flashBag = $this->get('session')->getFlashBag();
                    $flashBag->add('smtc_warning', 'Numero de Carpeta ya existe');
                }
            }
        }
        return $this->render('AdministracionBundle:Tramite:nuevo.html.twig', array(
            'usuario'   =>  $usuario,
            'entity'    =>  $entity,
            'form' => $form->createView(),
        ));
    }

    public function bclienteAction()
    {
        $peticion = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClienteBundle:Cliente')->findOneByNumeroDocumento($peticion->get('busqueda'));
        $entity2 = $em->getRepository('ClienteBundle:Cliente')->consultan($peticion->get('busqueda'));

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

    public function verAction($tramite_id)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $this->get('security.context')->getToken()->getUser();
        $funenvio = '';
        $documento = new DocumentoModel();
        $form = $this->createForm(new DocumentoType(), $documento);

        $gasto  = new GastoModel();
        $formgasto = $this->createForm(new GastoType(), $gasto);

        $envio = new EnvioModel();

        if ($usuario->getCargo() == "ADMINISTRADOR")
        {
            $funenvio = 'LIQUIDADOR';
        }
        if ($usuario->getCargo() == "LIQUIDADOR")
        {
            $funenvio = 'TRAMITADOR';
        }

        $formenvio = $this->createForm(new EnvioType($funenvio), $envio);

        $entity = $em->getRepository('TramiteBundle:Tramite')->findOneById($tramite_id);

        return $this->render('AdministracionBundle:Tramite:ver.html.twig', array(
            'usuario'   =>  $usuario,
            'entity'    =>  $entity,
            'form'      =>  $form->createView(),
            'form1'     =>  $formgasto->createView(),
            'form2'     =>  $formenvio->createView(),
            'funenvio'  => $funenvio
        ));
    }

    /**
     * @Pdf()
     */
    public function imprimirAction($tramite_id)
    {
        $em = $this->getDoctrine()->getManager();

        $format = $this->get('request')->get('_format');

        $entity = $em->getRepository('TramiteBundle:Tramite')->findOneById($tramite_id);

        return $this->render(sprintf('AdministracionBundle:Tramite:imprimir.%s.twig', $format),array(
            'entity'    =>  $entity
        ));
    }

    public function remitirAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $et = $em->getRepository('AdministracionBundle:EmpleadoTramite')->findTramiteEmP($id);
        $usuario = $this->get('security.context')->getToken()->getUser();
        $funenvio = '';

        if ($usuario->getCargo() == "ADMINISTRADOR")
        {
            $funenvio = 'LIQUIDADOR';
        }
        if ($usuario->getCargo() == "LIQUIDADOR")
        {
            $funenvio = 'TRAMITADOR';
        }

        $entity = new EnvioModel();
        $form = $this->createForm(new EnvioType($funenvio), $entity);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            $et->setEstado(false);
            $em->persist($et);

            $empt = new EmpleadoTramite();

            $emple = $em->getRepository('AdministracionBundle:Empleado')->findOneById($entity->funcionario);

            $empt->setTramite($et->getTramite());
            $empt->setEmpleado($emple);

            $em->persist($empt);

            $em->flush();
            return $this->redirect($this->generateUrl('empleado_tramite_home'));
        }
        return $this->redirect($this->generateUrl('empleado_tramite_ver', array('tramite_id' => $id)));
    }

    public function anexo1Action(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $tramite = $em->getRepository('TramiteBundle:Tramite')->findOneById($id);

        $tramite->setNumeroC($request->get('numeroc'));
        $tramite->setCanal($request->get('canal'));
        $tramite->setFechaVC($request->get('fechac'));

        $em->persist($tramite);
        $em->flush();
        return $this->redirect($this->generateUrl('empleado_tramite_ver', array('tramite_id' => $id)));
    }

    public function anexo2Action(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $tramite = $em->getRepository('TramiteBundle:Tramite')->findOneById($id);

        $tramite->setVista($request->get('vista'));
        $tramite->setAforo($request->get('fechaaforo'));
        $tramite->setLevante($request->get('fechalevante'));

        $em->persist($tramite);
        $em->flush();
        return $this->redirect($this->generateUrl('empleado_tramite_ver', array('tramite_id' => $id)));
    }
} 