<?php

namespace Cesa\Bundle\BackendBundle\Model;
use Symfony\Component\Validator\Constraints as Assert;

class DocumentoModel
{
    /**
    * @Assert\NotBlank()
    */
    public $codigo;

    /**
    * @Assert\NotBlank()
    */
    public $descripcion;

}