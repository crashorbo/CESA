<?php

namespace Cesa\Bundle\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpleadoModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres')
            ->add('apPaterno')
            ->add('apMaterno')
            ->add('cargo', 'choice', array( 'choices' => array(
                                                            'TRAMITADOR'    =>  'TRAMITADOR',
                                                            'ADMINISTRADOR' =>  'ADMINISTRADOR',
                                                            'LIQUIDADOR'    =>  'LIQUIDADOR',
                                                            'CAJERO'        =>  'CAJERO')))
            ->add('username')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cesa\Bundle\BackendBundle\Model\EmpleadoModel'
        ));
    }

    public function getName()
    {
        return 'cesa_backend_empleado';
    }
}
