<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created_by',
    ];
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_stores', 'store_id', 'user_id');
    }
    public function products()
    {
        return $this->belongsToMany('App\Models\ProductService', 'product_stores', 'store_id', 'product_id');
    }
    public function items()
    {
        return $this->hasMany('App\Models\InvoiceProduct', 'store_id', 'id');
    }
}
