<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable=['name','phone','image','email','user_id','status'];
    protected $table='staffs';

}
