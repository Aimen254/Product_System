<?php

namespace App\Models;

use App\Models\Tax;
use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'sale_price',
        'purchase_price',
        'tax_id',
        'category_id',
        'unit_id',
        'type',
        'acount_id',
        'warehouse_id',
        'created_by',
    ];

    public static $product_status=[
        'on_hold' => 'On Hold',
        'pending' => 'Pending',
        'approve' => 'Approve',
        'disapprove' => 'Disapproved'
    ];
    public static $purchase_status=[
        'purchased' => 'Purchased',
        'not_purchase' => 'Not Purchase',
        'outofstock' => 'Out of Stock',
        'other' => 'Other'
    ];
      public static $produ_type=[
        'Amazon' => 'Amazon',
        'Walmart' => 'Walmart'
    ];
    public static $delivery_status=[
        'pickup' => 'Pickup',
        'delivered' => 'Delivered'
    ];
    public static $recieved_status=[
        'recieved' => 'Recieved',
        'not recieved' => 'Not Recieved'
    ];
    public static $dim_status=[
        '10x 10x 10x' => '10x 10x 10x',
        '12x 12x 12x' => '12x 12x 12x',
        '14x 14x 12x' => '14x 14x 14x',
        '16x 16x 16x' => '16x 16x 16x',
        'none' => 'nones',
    ];
    public static $status_color = [
        'on_hold' => 'warning',
        'pending' => 'info',
        'approve' => 'success',
        'disapprove' => 'danger',
    ];

    public function threepls()
    {
        return $this->hasmany('App\Models\ProductThpl', 'product', 'id');
    }
    public function taxes()
    {
        return $this->hasOne('App\Models\Tax', 'id', 'tax_id')->first();
    }

    public function unit()
    {
        return $this->hasOne('App\Models\ProductServiceUnit', 'id', 'unit_id')->first();
    }

    public function category()
    {
        return $this->hasOne('App\Models\ProductServiceCategory', 'id', 'category_id');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_products', 'product_id', 'user_id');
    }
    public function stores()
    {
        return $this->belongsToMany('App\Models\Store', 'product_stores', 'product_id', 'store_id');
    }
    public function warehouse()
    {
        return $this->hasOne('App\Models\Warehouse', 'id', 'warehouse_id');
    }
    public function thpl($taxes)
    {
        if(is_array($taxes)){
            $taxArr = explode(',', $taxes);

            $taxes  = [];
            foreach($taxArr as $tax)
            {
                $taxes[] = Threepl::find($tax);
            }
    
            return $taxes;
        }else{
            $taxes = Threepl::find($taxes);
            return $taxes;
        }
      
    }
    public function acount($taxes)
    {
        $taxArr = explode(',', $taxes);

        $taxes  = [];
        foreach($taxArr as $tax)
        {
            $taxes[] = Acount::find($tax);
        }

        return $taxes;
    }
    public function tax($taxes)
    {
        $taxArr = explode(',', $taxes);

        $taxes  = [];
        foreach($taxArr as $tax)
        {
            $taxes[] = Tax::find($tax);
        }

        return $taxes;
    }

    public function taxRate($taxes)
    {
        $taxArr  = explode(',', $taxes);
        $taxRate = 0;
        foreach($taxArr as $tax)
        {
            $tax     = Tax::find($tax);
            $taxRate += $tax->rate;
        }

        return $taxRate;
    }

    public static function taxData($taxes)
    {
        $taxArr = explode(',', $taxes);

        $taxes = [];
        foreach($taxArr as $tax)
        {
            $taxesData = Tax::find($tax);
            $taxes[]   = !empty($taxesData) ? $taxesData->name : '';
        }

        return implode(',', $taxes);
    }



}
