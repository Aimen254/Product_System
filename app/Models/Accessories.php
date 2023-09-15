<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'type',
        'created_by',
    ];
    public function types()
    {
        return $this->hasOne('App\Models\AccessType', 'id', 'type')->first();
    }
}
