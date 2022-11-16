<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['TenSP','SoLuong','Gia','GiamGia','MaDM','ThongTin','TrangThai','Image'];

    protected $primaryKey='MSSP';

    protected $table='sanpham';

    public function receiptDetails()
    {
        return $this->hasMany(ReceiptDetails::class, 'MSSP', 'MSSP');
    }
}
