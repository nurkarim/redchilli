<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    protected $guarded =['id'];
   protected $table ="food_menus";

   public function items()
    {
       return $this->hasMany(Product::class,'food_menus_id','id');
    }
}
