<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffProduct extends Model
{
    protected $fillable=['staff_id','product_id'];
    protected $table='staff_product';
}
