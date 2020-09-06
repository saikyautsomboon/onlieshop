<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;
use App\Subcategory;

class Category extends Model
{
    protected $fillable = [
        'name', 'photo',
    ];
    public function subcategories($value='')
    {
    	return $this->hasMany('App\Subcategory');
        
    }
    public function items($value='')
    {
    	return $this->hasMany('App\Item');
    }
}
