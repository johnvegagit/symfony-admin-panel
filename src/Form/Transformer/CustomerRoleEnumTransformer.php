<?php

namespace App\Form\Transformer;

use App\Enum\CustomerRoleEnum;
use Symfony\Component\Form\DataTransformerInterface;

class CustomerRoleEnumTransformer implements DataTransformerInterface
{
    public function transform($value): ?string
    {
        return $value ? $value->value : null;
    }

    public function reverseTransform(mixed $value): mixed
    {
        return $value ? CustomerRoleEnum::from($value) : null;
    }
}
