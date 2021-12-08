<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'total', 'type_payment', 'status', 'provider_id', 'comment'
    ];

    public function products () {
        return $this->belongsToMany('App\Models\Product', 'expense_products', 'expense_id', 'product_id')->withPivot('quantity', 'price', 'created_at');
    }

    public function provider () {
        return $this->belongsTo('App\Models\Provider', 'provider_id', 'id');
    }

    public function syncProducts (array $products) {
        $data = [];
        $productsFormat = $this->products->map(function($q){
            return  [
                'id' => $q->id,
                'quantity' => $q->pivot->quantity
            ];
        });
        $productsFormat = collect($productsFormat);
        foreach ($products as $key => $item) {
            $data[$item['product_id']] = [
                'price' => $item['price_purchase'],
                'quantity' => $item['quantity']
            ];
            $productWithPivot = $this->products()->where('products.id', $item['product_id'])->first();
            $product = Product::find($item['product_id']);
            if (!empty($productWithPivot)) {
                $product->decrementQuantity($productWithPivot->pivot->quantity);
                $product->incrementQuantity($item['quantity']);
                // $product->price_purchase = $item['price_purchase'];
            } else {
                $product->incrementQuantity($item['quantity']);
                // $product->price_purchase = $item['price_purchase'];
            }
            // $product->save();
        }
        $resultSync = $this->products()->sync($data);
        foreach ($resultSync['detached'] as $key => $id) {
            $existProduct = $productsFormat->where('id', $id)->first();
            if (!empty($existProduct)) {
                $product = Product::find($existProduct['id']);
                $product->decrementQuantity($existProduct['quantity']);
            }
        }
    }
    
}
