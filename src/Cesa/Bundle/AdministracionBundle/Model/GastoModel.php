<?php
namespace Cesa\Bundle\AdministracionBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class GastoModel
{
    /**
     * @Assert\NotBlank()
     */
    public $detalle;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="float")
     */
    public $costo;
}