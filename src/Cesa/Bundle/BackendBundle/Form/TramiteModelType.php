<?php

namespace Cesa\Bundle\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TramiteModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numInterno')
            ->add('numCarpeta')
            ->add('cliente', 'hidden')
            ->add('tipo', 'choice', array(
                'choices' => array(
                    'IM4'  =>  'IM4',
                    'IMM4'   =>  'IMM4'
                )))
            ->add('placa')
            ->add('canal')
            ->add('vista')
            ->add('aforo')
            ->add('levante')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cesa\Bundle\BackendBundle\Model\TramiteModel',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'cesa_backend_cliente';
    }
}
