<?php

namespace Cesa\Bundle\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClienteModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres')
            ->add('apellidoPaterno')
            ->add('apellidoMaterno')
            ->add('tipoDocumento', 'choice', array(
                'choices' => array(
                    'CI' => 'Cedula de Identidad',
                    'Pasaporte' => 'Pasaporte'
                )
            ))
            ->add('numeroDocumento')
            ->add('telefono')
            ->add('celular')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cesa\Bundle\BackendBundle\Model\ClienteModel'
        ));
    }

    public function getName()
    {
        return 'cesa_backend_cliente';
    }
}
