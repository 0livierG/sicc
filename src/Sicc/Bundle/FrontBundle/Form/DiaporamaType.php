<?php

namespace Sicc\Bundle\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DiaporamaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image')
            ->add('titre')
            ->add('date')
            ->add('realisation')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sicc\Bundle\FrontBundle\Entity\Diaporama'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sicc_bundle_frontbundle_diaporama';
    }
}
