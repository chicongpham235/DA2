<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';
    protected $primaryKey ='id';
    protected $fillable = ['color','code'];

    public function sanphams(){
        return $this->belongsToMany(Sanpham::class, 'color_sanpham');
    }

    // public function colorsanpham(){
    //     return $this->hasMany(ColorSanpham::class, 'color_id','id');
    // }
}
