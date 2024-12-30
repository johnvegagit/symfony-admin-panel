<?php

namespace App\Form;

use App\Entity\Product;
use App\Enum\StatusEnum;
use App\Form\Transformer\StatusEnumTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    private DataTransformerInterface $statusEnumTransformer;

    public function __construct(StatusEnumTransformer $statusEnumTransformer)
    {
        $this->statusEnumTransformer = $statusEnumTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('price')
            ->add('stock')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Active' => StatusEnum::Active->value,
                    'Inactive' => StatusEnum::Inactive->value,
                    'Pending' => StatusEnum::Pending->value,
                ],
                'required' => true,
                'placeholder' => 'Selecciona en estado'
            ])
            ->add('creat_at', null, [
                'widget' => 'single_text',
            ])
            ->get('status')
            ->addModelTransformer($this->statusEnumTransformer)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
