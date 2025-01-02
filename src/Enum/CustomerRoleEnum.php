<?php

namespace App\Enum;

enum CustomerRoleEnum: string
{
    case Client = 'Client';
    case Admin = 'Admin';
}