<?php

namespace Cesa\Bundle\BackendBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ClienteModel
{
    /**
     * @Assert\NotBlank()
     */
    public $nombres;

    /**
     * @Assert\NotBlank()
     */
    public $apellidoPaterno;

    /**
     * @Assert\NotBlank()
     */
    public $apellidoMaterno;

    /**
     * @Assert\NotBlank()
     */
    public $tipoDocumento;

    /**
     * @Assert\NotBlank()
     */
    public $numeroDocumento;

    /**
     * @Assert\NotBlank()
     */
    public $telefono;

    /**
     * @Assert\NotBlank()
     */
    public $celular;
}