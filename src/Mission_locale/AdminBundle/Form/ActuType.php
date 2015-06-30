<?php

namespace Mission_locale\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Mission_locale\AdminBundle\Form\MediaType;

class ActuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre','text',array('label' => 'Titre l\'actualité : '))
            ->add('image', new MediaType(),array('label' => 'Image du slider ( Taille de l\'image 600*300)'))
            ->add('thumb', new MediaType(),array('label' => 'Miniature'))
            ->add('description','text',array('label' => 'Description de l\'article : ', 'max_length' => '250'))
            ->add('contenu','textarea',
        array('label' => 'Contenu de l\'actualité','attr' => array('class' => 'ckeditor')))
            ->add('isPublished','choice',array(
                'choices' => array(
                    1 => 'Oui',
                    2 => 'Programmé',
                    0 => 'Masqué'

                ),
                'label' => 'Publié maintenant ?',
                'multiple' => false,
                'expanded' => true,
            ))
            ->add('dateDebut','datetime',array('label' => 'Date de publication'))
            ->add('add','submit',array('label' => 'Ajouter', 'attr' => array('style' => 'float: right')));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mission_locale\AdminBundle\Entity\Actu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mission_locale_adminbundle_actu';
    }
}
