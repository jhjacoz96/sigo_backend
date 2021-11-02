<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'document', 'comment', 'status', 'type_document_id', 'user_id'
    ];

    public function user () {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    public function cartProducts () {
        return $this->belongsToMany('App\Models\Product', 'carts', 'client_id', 'product_id')->withPivot('quantity', 'product_id', 'client_id', 'id');
    }

    public function favoriteProducts () {
        return $this->belongsToMany('App\Models\Product', 'favorites', 'client_id', 'product_id')->withPivot('product_id', 'client_id', 'id');
    }

    public function cart () {
        return $this->hasMany('App\Models\Cart', 'client_id', 'id');
    }

    public function orders () {
        return $this->hasMany('App\Models\Order', 'client_id', 'id');
    }

    public function favorite () {
        return $this->hasMany('App\Models\Favorite', 'client_id', 'id');
    }
}
