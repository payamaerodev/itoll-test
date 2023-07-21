<?php


namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

class Role extends Enum
{
    public const COURIER = 'courier';
    public const SET = 'setClient';


}
