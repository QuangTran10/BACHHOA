<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['HoTenGH', 'GioiTinh', 'SDT', 'Email', 'Password', 'DiaChi', 'ThanhPho'];

    protected $primaryKey='MSGH';

    protected $table='giaohang';
}
