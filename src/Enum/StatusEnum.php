<?php

namespace App\Enum;

enum StatusEnum: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Pending = 'Pending';
}