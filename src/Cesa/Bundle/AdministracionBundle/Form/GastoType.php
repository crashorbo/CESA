<?php

namespace Cesa\Bundle\AdministracionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GastoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('detalle', 'textarea')
            ->add('costo')
        ;
    }

    public function getName()
    {
        return 'gasto';
    }
}