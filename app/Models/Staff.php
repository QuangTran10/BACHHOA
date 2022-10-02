<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['HoTenNV','GioiTinh','Ngay','Thang','Nam','SDT','DiaChi','ChucVu','Email','MatKhau','TrangThai','Avatar'];

    protected $primaryKey='MSNV';

    protected $table='nhanvien';

    public function roles(){
    	return $this->belongsToMany('App\Models\Roles');
    }

    public function getAuthPassword(){
    	return $this->MatKhau;
    }
}
