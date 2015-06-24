<?php

namespace Mission_locale\AdminBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('email','email',array('required' => false));
        $builder->add('roles','choice',array(
            'choices' =>  array('ROLE_ADMIN' => 'Administrateur',
                'ROLE_MODERATEUR' => 'Modérateur',
                'ROLE_OFFRE' => 'Gestion des offres',
                'ROLE_APPEL' => 'Gestion des appel')
         ,'multiple' => true
        ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'mission_locale_user_registration';
    }
}