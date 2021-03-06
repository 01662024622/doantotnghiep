<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'user_id', 'image', 'description','rate', 'rate_number','status','category_id'
    ];

    public function providor()
    {
        return $this->belongsTo('App\User');
    }
}
