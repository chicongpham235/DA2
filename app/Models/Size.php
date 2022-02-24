<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sanpham;

class Size extends Model
{
    use HasFactory;
    protected $table = 'size';

    public function sanphams(){
        return $this->belongsToMany(Sanpham::class, 'size_sanpham');
    }
}
