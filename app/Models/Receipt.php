<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['ThanhTien','NgayLap', 'GhiChu','TinhTrang', 'TG_Tao', 'TG_CapNhat'];

    protected $primaryKey='MaPhieu';

    protected $table='phieuthu';

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'MSNV', 'MSNV');
    }

    public function producer()
    {
        return $this->belongsTo(Producer::class, 'MaNCC', 'MaNSX');
    }

    public function receiptDetails()
    {
        return $this->hasMany(ReceiptDetails::class, 'MaPhieu', 'MaPhieu');
    }
}
