<?php

namespace Cesa\Bundle\AdministracionBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ClienteModel
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max = "100")
     * @Assert\Regex(pattern="/^[A-Z]{1}+[a-zA-Z]*$/", match=true, message="formato no valido")
     */
    public $nombres;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max = "100")
     * @Assert\Regex(pattern="/^[A-Z]{1}+[a-zA-Z]*$/", match=true, message="formato no valido")
     */
    public $apellidoPaterno;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max = "100")
     * @Assert\Regex(pattern="/^[A-Z]{1}+[a-zA-Z]*$/", match=true, message="formato no valido")
     */
    public $apellidoMaterno;

    /**
     * @Assert\NotBlank()
     */
    public $tipoDocumento;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type = "integer", message = "formato no valido")
     */
    public $numeroDocumento;

    /**
     * @Assert\Email(
     *     message = "La direccion de correo no es valida",
     *     checkMX = true)
     */
    public $email;
    /**
     * @Assert\Type(type = "integer", message = "formato no valido")
     */
    public $telefono;

    /**
     * @Assert\Type(type = "integer", message = "formato no valido")
     */
    public $celular;
}