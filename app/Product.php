<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{
   
   use Userstamps;
   protected $guarded =['id'];
   protected $table ="products";

   public function category()
   {
   	 return $this->belongsTo(Category::class,'category_id','id');
   }

   public function foodMenu()
   {
   	 return $this->belongsTo(FoodMenu::class,'food_menus_id','id');
   }

   public function subItems()
   {
       return $this->hasMany(MenusItem::class,'product_id','id');
      
   }
}
