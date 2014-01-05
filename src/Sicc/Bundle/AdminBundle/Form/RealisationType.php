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
            ->add('titre','text',array("label"=>"Titre de la réalisation"))
            ->add('description',null,array("label"=>"Description de la réalisation"))
            ->add('illustration','file',array("label"=>"Illustration de la réalisation","data_class"=>null))
            ->add('commanditaire','text',array("label"=>"Commanditaire de la réalisation"))
            ->add('date','text',array("label"=>"Date de la réalisation"))
            ->add('codePostal','text',array("label"=>"Code postal de la réalisation"))
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
