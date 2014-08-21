<?php
namespace Cesa\Bundle\AdministracionBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class DocumentoModel
{
    /**
     * @Assert\Type("Cesa\Bundle\TramiteBundle\Entity\Documento")
     * @Assert\NotBlank()
     */
    public $documento;

    /**
     *
     * @Assert\NotBlank()
     */
    public $tipoDocumento;
}