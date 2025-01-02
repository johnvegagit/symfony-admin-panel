<?php

namespace App\Form;

use App\Entity\Customer;
use App\Enum\CustomerRoleEnum;
use App\Form\Transformer\CustomerRoleEnumTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    private DataTransformerInterface $customerRoleEnumTransformer;

    public function __construct(CustomerRoleEnumTransformer $customerRoleEnumTransformer)
    {
        $this->customerRoleEnumTransformer = $customerRoleEnumTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('password')
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'Client' => CustomerRoleEnum::Client->value,
                    'Admin' => CustomerRoleEnum::Admin->value,
                ],
                'required' => true,
                'placeholder' => 'Selecciona un role'
            ])
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->get('role')
            ->addModelTransformer($this->customerRoleEnumTransformer)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
