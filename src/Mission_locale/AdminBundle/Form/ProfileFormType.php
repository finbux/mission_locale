<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mission_locale\AdminBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{ public function buildForm(FormBuilderInterface $builder, array $options)
{
    parent::buildForm($builder, $options);
    $builder->add('email','email',array('required' => false));
    $builder->add('roles','choice',array(
        'choices' =>
            array('ROLE_ADMIN' => 'Administrateur',
                'ROLE_MODERATEUR' => 'Modérateur',
                'ROLE_OFFRE' => 'Gestion des offres',
                 'ROLE_APPEL' => 'Gestion des appel')
    ,'multiple' => true
    ));
}

    public function getParent()
    {
        return 'fos_user_profile';
    }

    public function getName()
    {
        return 'mission_locale_user_profile';
    }
}
