<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'quantity', 'product_id', 'provider_id', 'update_at', 'created_at'
    ];
}
