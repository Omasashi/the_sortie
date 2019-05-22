<?php

namespace App\Form;

use App\Entity\Participants;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('mail',TextType::class,['attr'=>['placeholder'=>'Pseudo']])
            ->add('mot_de_passe',PasswordType::class, ['attr'=>['placeholder'=>'Password']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}
