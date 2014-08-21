<?php

namespace Cesa\Bundle\TramiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\DateTime;

/**
 * TramiteDocumento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TramiteDocumento
{
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Cesa\Bundle\TramiteBundle\Entity\Tramite")
     * @ORM\Id
     */
    protected $tramite;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Cesa\Bundle\TramiteBundle\Entity\Documento")
     * @ORM\Id
     */
    protected $documento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_presentacion", type="date")
     */
    protected $fechaPresentacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_documento", type="string", length = 255)
     */
    protected $tipoDocumento;
    
    public function __construct()
    {
        $this->setFechaPresentacion(new \DateTime());
    }
    /**
     * Set fechaPresentacion
     *
     * @param \DateTime $fechaPresentacion
     * @return TramiteDocumento
     */
    public function setFechaPresentacion($fechaPresentacion)
    {
        $this->fechaPresentacion = $fechaPresentacion;
    
        return $this;
    }

    /**
     * Get fechaPresentacion
     *
     * @return \DateTime 
     */
    public function getFechaPresentacion()
    {
        return $this->fechaPresentacion;
    }

    /**
     * Set tramite
     *
     * @param \Cesa\Bundle\TramiteBundle\Entity\Tramite $tramite
     * @return TramiteDocumento
     */
    public function setTramite(\Cesa\Bundle\TramiteBundle\Entity\Tramite $tramite)
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
     * Set documento
     *
     * @param \Cesa\Bundle\TramiteBundle\Entity\Documento $documento
     * @return TramiteDocumento
     */
    public function setDocumento(\Cesa\Bundle\TramiteBundle\Entity\Documento $documento)
    {
        $this->documento = $documento;
    
        return $this;
    }

    /**
     * Get documento
     *
     * @return \Cesa\Bundle\TramiteBundle\Entity\Documento 
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set tipoDocumento
     *
     * @param string $tipoDocumento
     * @return TramiteDocumento
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return string
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
}