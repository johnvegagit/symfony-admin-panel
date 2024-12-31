<?php

// src/Form/SearchType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType as InputSearchType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('query', InputSearchType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Buscar por nombre, descripción, etc.',
                ],
            ]);
    }
}
