<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total', 'type_payment', 'status', 'client_id', 'comment', 'code', 'name_delivery', 'phone_delivery', 'cost_delivery', 'comment_delivery', 'address_delivery',
    ];

    public function products () {
        return $this->belongsToMany('App\Models\Product', 'order_products', 'order_id', 'product_id')->withPivot('quantity', 'price');
    }

    public function client () {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id');
    }

    public function syncProducts (array $products) {
        $data = [];
        $productsFormat = [];
        if ($this->count() > 0){
            $productsFormat = $this->products->map(function($q){
                return  [
                    'id' => $q->id,
                    'quantity' => $q->pivot->quantity
                ];
            });
        }
        foreach ($products as $key => $item) {
            $data[$item['product_id']] = [
                'price' => $item['price_sale'],
                'quantity' => $item['quantity']
            ];
            if ($this->status == 'proceso') {
                $product = Product::find($item['product_id']);
                $product->decrementQuantity($item['quantity']);
                /* $productWithPivot = $this->products()->where('products.id', $item['product_id'])->first();
                $product = Product::find($item['product_id']);
                if (!empty($productWithPivot)) {
                    $product->incrementQuantity($productWithPivot->pivot->quantity);
                    $product->decrementQuantity($item['quantity']);
                } else {
                    $product->decrementQuantity($item['quantity']);
                } */
            }
        }
        $resultSync = $this->products()->sync($data);
        /* if ($this->status == 'verificar') {
            foreach ($resultSync['detached'] as $key => $id) {
                $existProduct = $productsFormat->where('id', $id)->first();
                if (!empty($existProduct)) {
                    $product = Product::find($existProduct['id']);
                    $product->incrementQuantity($existProduct['quantity']);
                }
            }
        } */
    }

}
