<?php

namespace Cesa\Bundle\AdministracionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmpleadoTramite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cesa\Bundle\AdministracionBundle\Entity\EmpleadoTramiteRepository")
 */
class EmpleadoTramite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="date")
     */
    private $fechaModificacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity="Cesa\Bundle\AdministracionBundle\Entity\Empleado")
     */
    protected $empleado;

    /**
    * @ORM\ManyToOne(targetEntity="Cesa\Bundle\TramiteBundle\Entity\Tramite")
    */
    protected $tramite;

    public function __construct()
    {
        $this->setFechaCreacion(new \DateTime());
        $this->setFechaModificacion(new \DateTime());
        $this->setEstado(true);
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return EmpleadoTramite
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return EmpleadoTramite
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    
        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return EmpleadoTramite
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set empleado
     *
     * @param \Cesa\Bundle\AdministracionBundle\Entity\Empleado $empleado
     * @return EmpleadoTramite
     */
    public function setEmpleado(\Cesa\Bundle\AdministracionBundle\Entity\Empleado $empleado = null)
    {
        $this->empleado = $empleado;
    
        return $this;
    }

    /**
     * Get empleado
     *
     * @return \Cesa\Bundle\AdministracionBundle\Entity\Empleado 
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Set tramite
     *
     * @param \Cesa\Bundle\TramiteBundle\Entity\Tramite $tramite
     * @return EmpleadoTramite
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
}