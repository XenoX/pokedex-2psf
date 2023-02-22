<?php

namespace App\Form;

use App\Entity\Pokedex;
use App\Entity\Pokemon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokedexType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('captured', CheckboxType::class, [
                'label' => 'Capturé ?',
                'required' => false,
            ])
            ->add('capturedAt', DateTimeType::class, [
                'label' => 'Date de capture',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'input' => 'datetime_immutable',
                'required' => false,
            ])
            ->add('pokemon', EntityType::class, [
                'class' => Pokemon::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokedex::class,
        ]);
    }
}
