<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Book extends Model
{
    use Softdeletes;
    protected $fillable = [
        'title','isbn','author','publisher','year','category_id','image_path',
    ];
    public function category(){
        return $this->hasOne('App\Category','id','category_id');
    }
}
