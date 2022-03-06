<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = true;

    protected $fillable = ['TenLoai', 'TrangThai'];

    protected $primaryKey='MaLoai';

    protected $table='loaihang';

    // public function Product()
    // {
    // 	return $this->belongsTo('App\Models\Product', 'foreign_key', 'MaLoaiHang');
    // }

}
