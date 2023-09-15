<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'product_id',
        'invoice_id',
        'amount',
    ];
    public function store(){
        return $this->hasMany('App\Models\Store', 'id', 'store_id')->first();
    }
}
