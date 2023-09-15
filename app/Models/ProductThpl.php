<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductThpl extends Model
{

    use HasFactory;
    public function threepls()
    {
        return $this->hasOne('App\Models\Threepl', 'id', 'threepl');
    }
     public function thpl($taxes)
    {
       
            $taxes = Threepl::find($taxes);
            return $taxes;
      
    }
}
