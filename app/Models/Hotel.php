<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $table = 'types123'; kalo beda nama table di databasenya

    // public function type(){
    //     return $this->belongsTo('App\Models\Type'); //hotel punya 1 type
    // }
    public function type(){
        return $this->belongsTo('App\Models\Type')->withTrashed();//tipe yg sudah dihapus bisa ditampilkan
    }
    public function products(){
        return $this->hasMany('App\Models\Product');

        // return $this->belongsToMany('App\Models\Product'); untuk manytomany
    }
}
