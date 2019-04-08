<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model
{
    use Sluggable;
    protected $guarded =['id'];
   protected $table ="categories";

   public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function foodMenus()
    {
       return $this->hasMany(Product::class,'category_id','id')->where('food_menus_id','!=',0)->groupBy('food_menus_id');
    }
}
