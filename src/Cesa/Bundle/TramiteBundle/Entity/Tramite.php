<?php

namespace Cesa\Bundle\TramiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tramite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cesa\Bundle\TramiteBundle\Entity\TramiteRepository")
 */
class Tramite
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
     * @ORM\Column(name="numero_interno", type="string", length=20)
     */
    protected $numeroInterno;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_carpeta", type="string", length=20)
     */
    protected $numeroCarpeta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date")
     */
    protected $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date")
     */
    protected $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20)
     */
    protected $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="placa", type="string", length=20)
     */
    protected $placa;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=50)
     */
    protected $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_c", type="string", length=20)
     */
    protected $numeroC;

    /**
     * @var string
     *
     * @ORM\Column(name="canal", type="string", length=20)
     */
    protected $canal;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_vc", type="string", length=255)
     */
    protected $fechaVC;

    /**
     * @var string
     *
     * @ORM\Column(name="vista", type="string", length=255)
     */
    protected $vista;

    /**
     * @var string
     *
     * @ORM\Column(name="aforo", type="string", length=20)
     */
    protected $aforo;

    /**
     * @var string
     *
     * @ORM\Column(name="levante", type="string", length=50)
     */
    protected $levante;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    protected $total;

    /**
     * @var float
     *
     * @ORM\Column(name="saldo", type="float")
     */
    protected $saldo;

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
     * @ORM\Column(name="activo", type="boolean")
     */
    protected $activo;

    /**
     * @ORM\ManyToOne(targetEntity="Cesa\Bundle\ClienteBundle\Entity\Cliente")
     */
    protected $cliente;

    /**
     * @ORM\OneToMany(targetEntity="Cesa\Bundle\TramiteBundle\Entity\TramiteDocumento", mappedBy="tramite")
     */
    protected $tramiteDocumentos;

    /**
     * @ORM\OneToMany(targetEntity="Cesa\Bundle\TramiteBundle\Entity\Movimiento", mappedBy="tramite")
     *
     */
    protected $movimientos;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tramiteDocumentos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->movimientos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setPlaca('');
        $this->setEstado('');
        $this->setNumeroC('');
        $this->setFechaVC('');
        $this->setCanal('');
        $this->setVista('');
        $this->setAforo('');
        $this->setLevante('');
        $this->setActivo(true);
        $this->setFechaCreacion(new \DateTime());
        $this->setFechaModificacion(new \DateTime());
        $this->setFechaInicio(new \DateTime());
        $this->setfechaFin(new \DateTime());
        $this->setTotal(number_format(0,2,',','.'));
        $this->setSaldo(number_format(0,2,',','.'));
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
     * Set numeroInterno
     *
     * @param string $numeroInterno
     * @return Tramite
     */
    public function setNumeroInterno($numeroInterno)
    {
        $this->numeroInterno = $numeroInterno;
    
        return $this;
    }

    /**
     * Get numeroInterno
     *
     * @return string 
     */
    public function getNumeroInterno()
    {
        return $this->numeroInterno;
    }

    /**
     * Set numeroCarpeta
     *
     * @param string $numeroCarpeta
     * @return Tramite
     */
    public function setNumeroCarpeta($numeroCarpeta)
    {
        $this->numeroCarpeta = $numeroCarpeta;
    
        return $this;
    }

    /**
     * Get numeroCarpeta
     *
     * @return string 
     */
    public function getNumeroCarpeta()
    {
        return $this->numeroCarpeta;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Tramite
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Tramite
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    
        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Tramite
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
     * Set placa
     *
     * @param string $placa
     * @return Tramite
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    
        return $this;
    }

    /**
     * Get placa
     *
     * @return string 
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Tramite
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

    /**
     * Set canal
     *
     * @param string $canal
     * @return Tramite
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;
    
        return $this;
    }

    /**
     * Get canal
     *
     * @return string 
     */
    public function getCanal()
    {
        return $this->canal;
    }

    /**
     * Set vista
     *
     * @param string $vista
     * @return Tramite
     */
    public function setVista($vista)
    {
        $this->vista = $vista;
    
        return $this;
    }

    /**
     * Get vista
     *
     * @return string 
     */
    public function getVista()
    {
        return $this->vista;
    }

    /**
     * Set aforo
     *
     * @param string $aforo
     * @return Tramite
     */
    public function setAforo($aforo)
    {
        $this->aforo = $aforo;
    
        return $this;
    }

    /**
     * Get aforo
     *
     * @return string 
     */
    public function getAforo()
    {
        return $this->aforo;
    }

    /**
     * Set levante
     *
     * @param string $levante
     * @return Tramite
     */
    public function setLevante($levante)
    {
        $this->levante = $levante;
    
        return $this;
    }

    /**
     * Get levante
     *
     * @return string 
     */
    public function getLevante()
    {
        return $this->levante;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Tramite
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set saldo
     *
     * @param float $saldo
     * @return Tramite
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    
        return $this;
    }

    /**
     * Get saldo
     *
     * @return float 
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Tramite
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
     * @return Tramite
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
     * Set activo
     *
     * @param boolean $activo
     * @return Tramite
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set cliente
     *
     * @param \Cesa\Bundle\ClienteBundle\Entity\Cliente $cliente
     * @return Tramite
     */
    public function setCliente(\Cesa\Bundle\ClienteBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Cesa\Bundle\ClienteBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Add tramiteDocumentos
     *
     * @param \Cesa\Bundle\TramiteBundle\Entity\TramiteDocumento $tramiteDocumentos
     * @return Tramite
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

    /**
     * Add movimientos
     *
     * @param \Cesa\Bundle\TramiteBundle\Entity\Movimiento $movimientos
     * @return Tramite
     */
    public function addMovimiento(\Cesa\Bundle\TramiteBundle\Entity\Movimiento $movimientos)
    {
        $this->movimientos[] = $movimientos;
    
        return $this;
    }

    /**
     * Remove movimientos
     *
     * @param \Cesa\Bundle\TramiteBundle\Entity\Movimiento $movimientos
     */
    public function removeMovimiento(\Cesa\Bundle\TramiteBundle\Entity\Movimiento $movimientos)
    {
        $this->movimientos->removeElement($movimientos);
    }

    /**
     * Get movimientos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMovimientos()
    {
        return $this->movimientos;
    }

    /**
     * Set numeroC
     *
     * @param string $numeroC
     * @return Tramite
     */
    public function setNumeroC($numeroC)
    {
        $this->numeroC = $numeroC;

        return $this;
    }

    /**
     * Get numeroC
     *
     * @return string
     */
    public function getNumeroC()
    {
        return $this->numeroC;
    }

    /**
     * Set fechaVC
     *
     * @param string $fechaVC
     * @return Tramite
     */
    public function setFechaVC($fechaVC)
    {
        $this->fechaVC = $fechaVC;

        return $this;
    }

    /**
     * Get fechaVC
     *
     * @return string
     */
    public function getFechaVC()
    {
        return $this->fechaVC;
    }
}