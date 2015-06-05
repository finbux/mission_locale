<?php

namespace Mission_locale\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OffreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomOffre','text',array('label' => 'Intitulé de l\'offre '))
            ->add('descriptionOffre','textarea',
                array('label' => 'Ajouter une description pour l\'offre','attr' => array('class' => 'ckeditor')))
            ->add('add','submit',array('label' => 'Ajouter'),array('attr' => array('class' => 'btn_ok')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mission_locale\MainBundle\Entity\Offre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mission_locale_adminbundle_appel';
    }
}
