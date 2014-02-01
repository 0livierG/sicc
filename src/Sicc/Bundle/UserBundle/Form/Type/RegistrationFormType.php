<?php

namespace Sicc\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder
            ->add('civilite', 'choice', array(
            'choices'   => array(
                'M'     => 'M',
                'Mme'   => 'Mme',
                'Mlle'  => 'Mlle',
            ),
            'multiple'  => false,
            'expanded'  =>true,
            ))
            ->add('prenom', 'text', array('label' => 'form.prenom', 'translation_domain' => 'FOSUserBundle'))
            ->add('societe','text');
    }

    public function getName()
    {
        return 'sicc_user_registration';
    }
}