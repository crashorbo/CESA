<?php
namespace Cesa\Bundle\AdministracionBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class EnvioModel
{
    /**
     * @Assert\Type("Cesa\Bundle\AdministracionBundle\Entity\Empleado")
     * @Assert\NotBlank()
     */
    public $funcionario;

}