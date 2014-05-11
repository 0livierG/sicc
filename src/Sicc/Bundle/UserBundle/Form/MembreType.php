<?php

namespace Sicc\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MembreType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text' , array('label' => 'nom', 'translation_domain' => 'FOSUserBundle'))
            ->add('email')
            ->add('locked','checkbox',array('label'=>'form.locked', 'required'=>false,'translation_domain' => 'FOSUserBundle'))
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
            ->add('societe','text', array('label' => 'form.societe', 'translation_domain' => 'FOSUserBundle'))
            ->add('groupes','entity',array('class' => 'Sicc\Bundle\AdminBundle\Entity\GroupeMembre','multiple'=>true));

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sicc\Bundle\UserBundle\Entity\Membre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sicc_bundle_userbundle_membre';
    }
}
