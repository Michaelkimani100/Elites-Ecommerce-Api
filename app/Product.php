<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable= [
        'category_id',
        'name',
        'company',
        'price',
        'features',
        'description'


    ];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
