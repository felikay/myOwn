<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $table = 'bids';
    protected $primarykey = 'id';
    protected $fillable = [
        'product_id',
        'amount',
        'bidder_email',
        'requested_units',
    ];

    public function posted()
    {
        return $this->belongsTo(Posted::class, 'product_id', 'product_id');
    }



    
        
}
