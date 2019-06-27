<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=[
        'product_id',
        'filename',
        'image',
        'mine',
        'original_filename'
    ];
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
