<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['HoTenKH','GioiTinh','NgaySinh','SDT','Email','MatKhau','TrangThai','Avatar'];

    protected $primaryKey='MSKH';

    protected $table='khachhang';
}