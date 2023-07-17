<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Posted extends Model
{
    use HasFactory;
    protected $table = 'posteds';
    protected $primaryKey = "product_id";
    
    
    
    protected $fillable = [
        'product_id',
        'product_name',
        'description',
        'reserve_price',
        'image',
        'start_time',
        'end_time',
        'seller_email',
        'available_units',
        'status',
        
    ];





    public function bids()
    {
        return $this->hasMany(Bid::class, 'product_id');
    }

    

    protected $dates = ['start_time', 'end_time'];

    public function getStatusAttribute()
    {
        $now = Carbon::now();

        if ($this->start_time > $now) {
            return 'not_in_progress';
        } elseif ($this->end_time > $now) {
            return 'in_progress';
        } else {
            return 'expired';
        }
    }

   

    
}
