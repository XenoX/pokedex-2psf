<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', TextType::class, [
                'attr' => [
                    'data' => $options['data']['lastUsername'],
                    'autofocus' => true,
                ],
            ])
            ->add('_password', PasswordType::class)
        ;
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
