<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $fillable = [
        'product_id',
        'invoice_id',
        'store_id',
        'quantity',
        'tax',
        'discount',
        'total',
    ];

    public function product(){
        return $this->hasOne('App\Models\ProductService', 'id', 'product_id')->first();
    }
    public function store(){
        return $this->hasOne('App\Models\Store', 'id', 'store_id')->first();
    }
    public function getSubTotal($items)
    {
        $subTotal = 0;
        foreach($items as $product)
        {
            $subTotal += ($product->price * $product->quantity) + ($product->boxcost * $product->boxno);
        }

        return $subTotal;
    }
}
