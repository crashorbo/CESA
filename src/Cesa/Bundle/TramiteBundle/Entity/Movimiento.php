<?php

namespace Cesa\Bundle\TramiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movimiento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Movimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text")
     */
    protected $detalle;

    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="decimal")
     */
    protected $monto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date")
     */
    protected $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    protected $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="Cesa\Bundle\TramiteBundle\Entity\Tramite")
     */
    protected $tramite;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255)
     */
    protected $estado;

    public function __construct()
    {
        $this->setFechaCreacion(new \DateTime());
        $this->setEstado('TRANSITO');
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     * @return Movimiento
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    
        return $this;
    }

    /**
     * Get detalle
     *
     * @return string 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set monto
     *
     * @param float $monto
     * @return Movimiento
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;
    
        return $this;
    }

    /**
     * Get monto
     *
     * @return float 
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Movimiento
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    
        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Movimiento
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set tramite
     *
     * @param \Cesa\Bundle\TramiteBundle\Entity\Tramite $tramite
     * @return Movimiento
     */
    public function setTramite(\Cesa\Bundle\TramiteBundle\Entity\Tramite $tramite = null)
    {
        $this->tramite = $tramite;
    
        return $this;
    }

    /**
     * Get tramite
     *
     * @return \Cesa\Bundle\TramiteBundle\Entity\Tramite 
     */
    public function getTramite()
    {
        return $this->tramite;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Movimiento
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }
}