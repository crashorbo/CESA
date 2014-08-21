<?php

namespace Cesa\Bundle\BackendBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class TramiteModel
{
    /**
     * @Assert\NotBlank()
     */
    public $numInterno;

    /**
     * @Assert\NotBlank()
     */
    public $numCarpeta;

    /**
     * @Assert\NotBlank()
     */
    public $cliente;

    /**
     * @Assert\NotBlank()
     */
    public $tipo;

    /**
     * @Assert\NotBlank()
     */
    public $placa;


    public $canal;


    public $vista;


    public $aforo;


    public $levante;
}