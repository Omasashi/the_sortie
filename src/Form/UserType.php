<?php

namespace App\Form;

use App\Entity\Participants;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('pseudo',TextType::class,['attr'=>['placeholder'=>'Pseudo']])
            ->add('nom',TextType::class,['attr'=>['placeholder'=>'Pseudo']])
            ->add('prenom',TextType::class,['attr'=>['placeholder'=>'Pseudo']])
            ->add('telephone',NumberType::class,['attr'=>['placeholder'=>'Pseudo']])
            ->add('mail',EmailType::class,['attr'=>['placeholder'=>'Pseudo']])
            ->add('mot_de_passe',RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>'The password fields must be matched',
                'required'=>true,
                'first_options'=>array('label'=>'Password'),
                'second_options'=>array('label'=>'Repeat password'),
                'label'=>false
            ],['attr'=>['placeholder'=>'Password']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}
