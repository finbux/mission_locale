<?php

namespace Mission_locale\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CgoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Contenu','textarea',
                array('label' => 'Modifier les conditions générales des offres','attr' => array('class' => 'ckeditor')))
            ->add('modifier','submit',array('label' => 'Modifier'),array('attr' => array('class' => 'btn_ok')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mission_locale\MainBundle\Entity\Cgo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mission_locale_mainbundle_cgo';
    }
}
