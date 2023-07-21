<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'destination_longitude',
        'destination_latitude',
        'sender_name',
        'receiver_name',
        'receiver_number',
        'sender_number',
        'source_longitude',
        'source_latitude',
        'source_address',
        'destination_address',
    ];
}
