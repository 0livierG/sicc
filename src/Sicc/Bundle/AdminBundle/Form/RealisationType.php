<?php

namespace Sicc\Bundle\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RealisationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre','text', array('label' => 'Titre'))
            ->add('description','text', array('label' => 'Description'))
            ->add('illustration','file', array('label' => 'Illustration de la réalisation', 'data_class'=>null))
            ->add('date','text',array('label'=>'Date de réalisation'))
            ->add('commanditaire','text',array('label'=>'Commanditaire du projet'))
            ->add('ville','text',array('label'=>'Ville'))
            ->add('codePostal','text',array('label'=>'Code postal'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sicc\Bundle\AdminBundle\Entity\Realisation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sicc_bundle_adminbundle_realisation';
    }
}
