<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primarykey = 'id';
    protected $fillable = [
        'user_name',
        'productName',
        'user_email',
        'description',
        'units',
        'image',
        'amount',
        'sellerEmail',
        'name',
        'email',
        'number',
        'address',
        'county',
        'delivery'
        
    ];
}
