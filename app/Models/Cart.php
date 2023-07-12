<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'email',
        'reserve_price',
        'image',
        'start_date',
        'end_date',
        
    ];

    
}