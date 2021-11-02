<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'document', 'comment', 'status', 'type_document_id', 'user_id'
    ];

    public function user () {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

     public function type_document () {
        return $this->belongsTo('App\Models\TypeDocument', 'type_document_id', 'id');
    }


}
