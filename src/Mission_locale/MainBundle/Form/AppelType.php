<?php

namespace Mission_locale\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class AppelType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', 'text', array('required' => false))
            ->add('telephone','text',array('max_length' => 14))
            //->add('utilisateurs','entity', array('class' => 'Mission_locale\UsersBundle\Entity\Users' ))
            ->add('Valider','submit',array('attr' => array('class' => 'btn-submit')));
    }

    public function getName()
    {
        return 'mission_locale_mainbundle_appel';
    }
}