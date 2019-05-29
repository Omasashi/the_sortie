<?php

namespace App\Form;

use App\Entity\Sorties;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnulerSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motif',TextareaType::class,['attr' => ['placeholder' => 'Motif', 'label' => false]])
            ->add('Enregistrer', SubmitType::class, ['attr' => ['class' => 'class="btn btn-outline-primary col-12"'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
