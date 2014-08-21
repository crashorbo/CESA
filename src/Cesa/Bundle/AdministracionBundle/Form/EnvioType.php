<?php

namespace Cesa\Bundle\AdministracionBundle\Form;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnvioType extends AbstractType
{
    protected $funcion;

    public function __construct($funcion)
    {
        $this->funcion = $funcion;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fun = $this->funcion;
        $builder
            ->add('funcionario', 'entity', array(
                'class'         => 'AdministracionBundle:Empleado',
                'query_builder' =>  function(EntityRepository $er) use ($fun){
                    return $er->createQueryBuilder('e')
                        ->where('e.cargo = :fun')
                        ->setParameter('fun', $fun);
                    }
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'    =>  'Cesa\Bundle\AdministracionBundle\Model\EnvioModel',
        ));
    }
    public function getName()
    {
        return 'funcionario';
    }
}