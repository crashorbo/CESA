<?php

namespace Cesa\Bundle\BackendBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class EmpleadoModel
{
    /**
     * @Assert\NotBlank()
     */
    public $nombres;

    /**
     * @Assert\NotBlank()
     */
    public $apPaterno;

    /**
     * @Assert\NotBlank()
     */
    public $apMaterno;

    /**
     * @Assert\NotBlank()
     */
    public $cargo;

    /**
     * @Assert\NotBlank()
     */
    public $username;
}