<?php

namespace Dp\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StuffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
                                                'required'   => true,
                                                'attr'       => array('class' => 'form-control'),
                                            ))
                ->add('keyword', 'text', array(
                                                'required'   => false,
                                                'attr'       => array('class' => 'form-control'),
                                              ))
                ->add('description', 'textarea', array(
                                                        'required'   => false,
                                                      ))
                ->add('online', 'checkbox', array(
                                                    'label'     => 'Afficher publiquement',
                                                    'required'  => false,
                                                ))
                ->add('user', 'entity', array(
                                                    'label'     => 'User',
                                                    'required'  => false,
                                                    'class' => 'DpUserBundle:User',
                                                    'property' => 'username',
                                                ))
                ->add('save', 'submit', array(
                                                'label' => 'Enregistrer',
                                                'attr'  => array('class' => 'btn btn-success'),
                                            ))
        ;

    }

    public function getName()
    {
        return 'stuff';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dp\MainBundle\Entity\Stuff',
        ));
    }
}