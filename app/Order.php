<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
class Order extends Model
{
	use Userstamps;
   protected $guarded =['id'];
   protected $table ="orders";

   public function carts()
   {
   	 return $this->hasMany(OrderCart::class,'order_id','id');
   }
}
