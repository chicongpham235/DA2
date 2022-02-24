<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nhomsanpham;
use App\Models\Size;
use App\Models\SizeSanpham;
use App\models\Color;
use App\Models\ColorSanpham;

class Sanpham extends Model
{
    use HasFactory;
    protected $table='sanpham';
    protected $fillable=['ten','mota','gia','giaban','anh','danhsachanh','trangthai','uutien','nhomsanphamid'];

    public function nhomsanpham(){
        return Nhomsanpham::find($this->nhomsanphamid);
    }

    public function sizes(){
        return $this->belongsToMany(Size::class,'size_sanpham');
    }

    public function colors(){
        return $this->belongsToMany(Color::class,'color_sanpham');
    }

}
