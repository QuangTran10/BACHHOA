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
    	return $this->belongsToMany('App\Models\Roles', 'cap_quyen', 'MSNV', 'id_quyen');
    }

    public function getAuthPassword(){
    	return $this->MatKhau;
    }

    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('quyen', $roles)->first();
    }

    public function hasRole($role){
        return null !== $this->roles()->where('quyen', $role)->first();
    }
}
