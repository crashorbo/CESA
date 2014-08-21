<?php

namespace Cesa\Bundle\AdministracionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('documento', 'entity', array(
                'class' => 'TramiteBundle:Documento'))
            ->add('tipoDocumento', 'choice', array('choices' => array(
                'FOTOCOPIA' =>  'FOTOCOPIA',
                'FAX'       =>  'FAX',
                'COPIA'     =>  'COPIA',
                'ORIGINAL'  =>  'ORIGINAL'
            )
            ))
        ;
    }

    public function getName()
    {
        return 'documento';
    }
}
