<?php

namespace Sicc\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;



class MembreEditType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options)
    {



     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

        $builder
            ->add('username')
            //->add('usernameCanonical')
            ->add('email')
            //->add('emailCanonical')
            //->add('enabled')
            //->add('salt')
           // ->add('password')
            //->add('lastLogin')
            //->add('locked')
            //->add('expired')
            //->add('expiresAt')
            //->add('confirmationToken')
            //->add('passwordRequestedAt')
            //->add('roles')
            //->add('credentialsExpired')
            //->add('credentialsExpireAt')
            //->add('groupe','entity', array('class' => 'SiccAdminBundle:GroupeMembre','property' => 'intitule'))
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
        return 'sicc_bundle_userbundle_membre_edit';
    }
}
