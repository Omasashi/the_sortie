<?php

namespace App\Form;

use App\Entity\Participants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifierProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo',null,["label"=>false])
            ->add('nom',null,["label"=>false])
            ->add('prenom',null,["label"=>false])
            ->add('telephone',null,["label"=>false])
            ->add('mail',null,["label"=>false])
            ->add('password',RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>'The password fields must be matched',
                'required'=>true,
                'mapped'=>false,
                'first_options'=>array('label'=>'Password : '),
                'second_options'=>array('label'=>'Confirmer password : '),
                'label'=>false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}
