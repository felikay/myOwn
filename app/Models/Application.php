<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';
    protected $primarykey = 'id';
    protected $fillable = [
        'user_name',
        'number',
        'date_of_birth',
        'address',
        'street',
        'country',
        'county',
        'city',
        'pin_code',
        'name',
        'email',
        'type',
        'national_id_front',
        'national_id_back',
        'proof_front',
        'proof_back',
        'status'
    ];

    protected function status(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["Not Accepted", "Accepted"  ][$value],
        );
    }

}
