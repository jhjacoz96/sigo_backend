<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleClient extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
		'quantity',
		'year',
		'amount',
		'client_id',
    ];
    public function client () {
    	return $this->belongsTo(Client::class);
    }
}
