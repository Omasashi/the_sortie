<?php

namespace App\Form;

use App\Entity\Lieux;
use App\Entity\Sorties;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifierSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['attr' => ['placeholder' => 'Nom de la sortie', 'label' => false]])
            ->add('dateDebut', DateTimeType::class, ['attr' => ['placeholder' => 'Date de début', 'label' => false], 'widget' => 'single_text'])
            ->add('duree', NumberType::class, ['attr' => ['placeholder' => 'Durée', 'label' => false]])
            ->add('dateCloture', DateTimeType::class, ['attr' => ['placeholder' => 'Date de cloturation', 'label' => false], 'widget' => 'single_text'])
            ->add('maxInscriptions', NumberType::class, ['attr' => ['placeholder' => 'Nombre maxi de participant(s)', 'label' => false]])
            ->add('infosescriptions', TextType::class, ['attr' => ['placeholder' => 'Descriptiion de la sortie', 'label' => false]])
            ->add('sortie', EntityType::class, ['class' => Lieux::class, 'choice_label' => 'nom_lieu'])
            ->add('Enregistrer', SubmitType::class, ['attr' => ['class' => 'class="btn btn-outline-primary col-12"'],])
            ->add('Supprimer', SubmitType::class, ['attr' => ['class' => 'class="btn btn-outline-primary col-12"'],])
            ->add('Publier', SubmitType::class, ['attr' => ['class' => 'class="btn btn-outline-primary col-12"'],])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
