<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffOrder extends Model
{
    protected $fillable=['staff_id','order_id'];
    protected $table='order_staff';
}
