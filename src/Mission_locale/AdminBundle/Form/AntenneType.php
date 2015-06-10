<?php

namespace Mission_locale\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AntenneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text',array('label' => 'Nom de l\'antenne : '))
            ->add('adresse','text', array('label' => 'L\'adresse de l\'antenne'))
            ->add('horaire','textarea',array('label' => 'Les horaires de l\'antenne','attr' => array('cols' => '90', 'rows' => '12')))
            ->add('cp','text',array('label' => 'Le code postal','attr' => array('style' => 'width: 100px;')))
            ->add('valider','submit',array('label' => 'Ajouter', 'attr' => array('class' => 'btn_ok', 'style' => 'float:right;')))
            ->add('coord','text',array('label' => 'Coordonnées GPS','attr' => array('readonly' => 'readonly')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mission_locale\AdminBundle\Entity\Antenne'
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
