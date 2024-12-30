<?php

namespace App\Form\Transformer;

use App\Enum\StatusEnum;
use Symfony\Component\Form\DataTransformerInterface;

class StatusEnumTransformer implements DataTransformerInterface
{
    public function transform($value): ?string
    {
        return $value ? $value->value : null;
    }

    public function reverseTransform(mixed $value): mixed
    {
        return $value ? StatusEnum::from($value) : null;
    }
}