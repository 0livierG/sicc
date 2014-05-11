<?php

namespace Sicc\Bundle\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class DiaporamaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('titre')
            ->add('file','file',array(
                    'required' => false,
                    'data_class' => null,
                    'label' => 'Image à afficher',
                    'attr' => array(
                        'class' => 'form-control upload-image',
                        'data-preview'=>'preview',
                        'data-input'=>'imageExistante'
                    )
                ))
            ->add('imageExistante','hidden',array(
                    'mapped' => false,
                    'attr' => array(
                        'class' => 'imageExistante'
                    )
                ))
            ->add('realisation','entity',array(
                    'class'=>'Sicc\Bundle\AdminBundle\Entity\Realisation',
                    'label'=>'Associer une réalisation',
                    'multiple'=>false,
                    'attr'=>array(
                        'class'=>'form-control'
                    )
                ))
            ->add('date','date',array(
                    'data'=> new \DateTime()
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sicc\Bundle\AdminBundle\Entity\Diaporama'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sicc_bundle_adminbundle_diaporama';
    }
}
