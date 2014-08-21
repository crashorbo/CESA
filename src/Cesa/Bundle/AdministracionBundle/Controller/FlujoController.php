<?php

namespace Cesa\Bundle\AdministracionBundle\Controller;

use Cesa\Bundle\AdministracionBundle\Form\GastoType;
use Cesa\Bundle\AdministracionBundle\Model\GastoModel;
use Cesa\Bundle\TramiteBundle\Entity\Movimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Ps\PdfBundle\Annotation\Pdf;

class FlujoController extends Controller{

    public function busquedaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tramite = $em->getRepository('TramiteBundle:Tramite')->findOneByNumeroInterno($request->get('parametro'));

        if($tramite != null)
        {
            return $this->redirect($this->generateUrl('tramite_flujo_tramite', array('id' => $tramite->getId())));
        }

        return $this->redirect($this->generateUrl('tramite_flujo_buscar'));
    }

    public function buscarAction(Request $request)
    {
        $usuario = $this->get('security.context')->getToken()->getUser();

        return $this->render('AdministracionBundle:Flujo:buscar.html.twig', array(
            'usuario'   =>  $usuario
        ));
    }

    public function tramiteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $ingreso = new GastoModel();
        $form = $this->createForm(new GastoType(), $ingreso);
        $tramite = $em->getRepository('TramiteBundle:Tramite')->findOneById($id);
        $usuario = $this->get('security.context')->getToken()->getUser();

        return $this->render('AdministracionBundle:Flujo:tramite.html.twig', array(
           'usuario'    =>  $usuario,
           'entity'     =>  $tramite,
           'form1'       =>  $form->createView()
        ));
    }

    public function desembolsarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $movimiento = $em->getRepository('TramiteBundle:Movimiento')->findOneById($id);

        $movimiento->setEstado('CANCELADO');
        $em->persist($movimiento);
        $em->flush();
        return $this->redirect($this->generateUrl('tramite_flujo_tramite', array('id' => $movimiento->getTramite()->getId())));
    }

    /**
     * @Pdf()
     */
    public function desembolsoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $format = $request->get('_format');

        $entity = $em->getRepository('TramiteBundle:Movimiento')->findOneById($id);
        $fecha = new \DateTime();
        $fechaImp = $fecha->format('d-m-Y/H:i');
        return $this->render(sprintf('AdministracionBundle:Flujo:desembolso.%s.twig', $format),array(
            'entity'    =>  $entity,
            'fecha'     =>  $fechaImp
        ));
    }

    /**
     * @Pdf()
     */
    public function estadotramiteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $format = $request->get('_format');

        $entity = $em->getRepository('TramiteBundle:Tramite')->findOneById($id);
        $fecha = new \DateTime();
        $fechaImp = $fecha->format('d-m-Y/H:i');
        return $this->render(sprintf('AdministracionBundle:Flujo:estadotramite.%s.twig', $format),array(
            'entity'    =>  $entity,
            'fecha'     =>  $fechaImp
        ));
    }

    public function agregaringresoAction(Request $request, $id)
    {
        $ingreso = new GastoModel();
        $form = $this->createForm(new GastoType(), $ingreso);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $tramite = $em->getRepository('TramiteBundle:Tramite')->findOneById($id);
            $movimiento = new Movimiento();
            $movimiento->setTramite($tramite);
            $movimiento->setDetalle($ingreso->detalle);
            $movimiento->setMonto($ingreso->costo);
            $movimiento->setTipo('INGRESO');
            $movimiento->setEstado('CANCELADO');
            $em->persist($movimiento);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tramite_flujo_tramite', array('id' => $id)));
    }
    public function movimientosdiaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fecha = new \DateTime();
        $entity = $em->getRepository('TramiteBundle:Movimiento')->findByFechaCreacion($fecha);
        $usuario = $this->get('security.context')->getToken()->getUser();

        return $this->render('AdministracionBundle:Flujo:movimientosdia.html.twig', array(
            'entity'    =>  $entity,
            'usuario'   =>  $usuario
        ));
    }

    /**
     * @Pdf()
     */
    public function movimientodiaAction(Request $request)
    {
        $format = $request->get('_format');
        $em = $this->getDoctrine()->getManager();
        $fecha = new \DateTime();
        $entity = $em->getRepository('TramiteBundle:Movimiento')->findByFechaCreacion($fecha);
        $fechaImp = $fecha->format('d-m-Y/H:i');
        return $this->render(sprintf('AdministracionBundle:Flujo:movimientosdia.%s.twig', $format),array(
            'entity'    =>  $entity,
            'fecha'   =>  $fechaImp
        ));
    }
}