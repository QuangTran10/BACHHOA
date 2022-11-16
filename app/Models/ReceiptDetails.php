<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptDetails extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['SoLuong','DonGia','TG_Tao','TG_CapNhat'];

    protected $primaryKey=['MaPhieu', 'MSSP'];

    protected $table='chitietphieuthu';

    public $incrementing = false;


    public function receipt()
    {
        return $this->belongsTo(Receipt::class,'MaPhieu', 'MaPhieu');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'MSSP', 'MSSP');
    }
}
