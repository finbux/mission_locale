<?php

namespace Mission_locale\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncartType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEncart','text',array('label' => 'Nom encart : '))
            ->add('contenu','textarea',array('label' => 'Contenu','attr' => array('class' => 'ckeditor')))
            ->add('Modifier','submit');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mission_locale\MainBundle\Entity\Encart'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mission_locale_mainbundle_encart';
    }
}
