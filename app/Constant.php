<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constant extends Model
{
    protected $fillable=['demeanor','responsiveness','competence','tangible','completeness','relevancy','accuracy','currency','training_provider','user_understanding','participation','easier_to_the_job','increase_productivity'];
    protected $table='consts';
}
