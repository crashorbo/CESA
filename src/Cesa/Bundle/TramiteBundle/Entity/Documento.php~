<?php

namespace Cesa\Bundle\TramiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documento
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cesa\Bundle\TramiteBundle\Entity\DocumentoRepository")
 */
class Documento
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
     * @ORM\Column(name="codigo", type="string", length=20)
     */
    protected $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    protected $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date")
     */
    protected $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="date")
     */
    protected $fechaModificacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    protected $estado;

    /**
     * @ORM\OneToMany(targetEntity="Cesa\Bundle\TramiteBundle\Entity\TramiteDocumento", mappedBy="documento")
     */
    protected $tramiteDocumentos;

    
    /**
     * Constructor
     */

    public function __toString()
    {
        return $this->getCodigo().' - '.$this->getDescripcion();
    }

    public function __construct()
    {
        $this->tramiteDocumentos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set codigo
     *
     * @param string $codigo
     * @return Documento
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Documento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Documento
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
     * @return Documento
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
     * @return Documento
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
     * Add tramiteDocumentos
     *
     * @param \Cesa\Bundle\TramiteBundle\Entity\TramiteDocumento $tramiteDocumentos
     * @return Documento
     */
    public function addTramiteDocumento(\Cesa\Bundle\TramiteBundle\Entity\TramiteDocumento $tramiteDocumentos)
    {
        $this->tramiteDocumentos[] = $tramiteDocumentos;
    
        return $this;
    }

    /**
     * Remove tramiteDocumentos
     *
     * @param \Cesa\Bundle\TramiteBundle\Entity\TramiteDocumento $tramiteDocumentos
     */
    public function removeTramiteDocumento(\Cesa\Bundle\TramiteBundle\Entity\TramiteDocumento $tramiteDocumentos)
    {
        $this->tramiteDocumentos->removeElement($tramiteDocumentos);
    }

    /**
     * Get tramiteDocumentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTramiteDocumentos()
    {
        return $this->tramiteDocumentos;
    }
}