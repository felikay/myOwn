<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'email',
        'category',
        'description',
        'reserve_price',
        'image',
        'start_date',
        'end_date',
        
    ];

    
}