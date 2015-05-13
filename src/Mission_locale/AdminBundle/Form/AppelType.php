<?php

namespace Mission_locale\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AppelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaire','textarea',array('label' => 'Commentaire : '))
            ->add('avancement','choice',
                array('choices' => array(
                    'A contacter' => 'A contacter',
                    'Message laissé' => 'Message laissé',
                    'RDV fixé' => 'RDV fixé',
                    'Renseigné' => 'Renseigné',)))
            ->add('update','submit',array('label' => 'mettre à jour'),array('attr' => array('class' => 'btn_ok')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mission_locale\MainBundle\Entity\Appel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mission_locale_mainbundle_appel';
    }
}
