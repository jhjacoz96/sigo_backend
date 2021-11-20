<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'code', 'name', 'price_sale', 'price_purchase', 'stock', 'status', 'comment', 'category_id'
    ];

    public function category () {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function image () {
        return $this->morphOne('App\Models\Image','imageable');
    }

    public function decrementQuantity ($quantity) {
        $this->decrement('stock', $quantity);
    }

    public function incrementQuantity ($quantity) {
        $this->increment('stock', $quantity);
    }

}
