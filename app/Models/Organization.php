<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'currency', 'address', 'city', 'country', 'phone', 'document', 'type_document_id'
    ];

    public function type_document () {
        return $this->belongsTo('App\Models\TypeDocument', 'type_document_id', 'id');
    }

}
