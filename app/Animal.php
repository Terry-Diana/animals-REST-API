<?php

namespace App;

use App\Http\Contollers\AnimalController;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
   protected $fillable = [
    	'title',
    	'description'
    ];
}
