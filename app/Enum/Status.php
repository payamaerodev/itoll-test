<?php


namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

class Status extends Enum
{
    public const TAKEN = 'TAKEN';
    public const DELIVERED = 'DELIVERED';
    public const CREATED = 'CREATED';
    public const CANCELED = 'CANCELED';


}
