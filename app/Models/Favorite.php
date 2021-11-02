<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'client_id'
    ];

    public function products () {
        return $this->hasMany('App\Models\Product', 'product_id', 'id');
    }

    public function clients () {
        return $this->hasMany('App\Models\Client', 'client_id', 'id');
    }

}
