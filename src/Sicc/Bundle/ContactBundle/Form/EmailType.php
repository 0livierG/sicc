<?php

namespace Sicc\Bundle\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmailType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text', array('label'=>'', 'attr'=>array('placeholder'=>'Votre nom', 'class'=>'input-xxlarge')))
            ->add('prenom','text',array('label'=>'', 'attr'=>array('placeholder'=>'Votre prénom', 'class'=>'input-xxlarge')))
            ->add('civilite', 'choice', array( 'choices' => array('Mlle' => 'Mlle', 'Mme' => 'Mme', 'M.'=>'M.'), 'empty_value'=>'Civilite', 'attr'=>array('class'=>'input-xxlarge')))
            ->add('email','text',array('label'=>'', 'attr'=>array('placeholder'=>'Votre email', 'class'=>'input-xxlarge')))
            ->add('telephone','text',array('label'=>'', 'attr'=>array('placeholder'=>'Votre nom', 'class'=>'input-xxlarge')))
            ->add('objet','text', array('label'=>'', 'attr'=>array('placeholder'=>'Objet', 'class'=>'input-xxlarge')))
            ->add('contenu','textarea',array('attr'=>array('placeholder'=>'Contenu du message',  'class'=>'contact-form-textarea')))
            ->add('submit', 'submit', array('label' => 'Envoyer'));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sicc\Bundle\ContactBundle\Entity\Email'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sicc_bundle_frontbundle_email';
    }
}
