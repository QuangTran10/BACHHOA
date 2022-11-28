<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['Ten', 'Email', 'DiaChi', 'SDT'];

    protected $primaryKey='MaNCC';

    protected $table='nhacungcap';

    public function receipt(){
        return $this->hasMany(Receipt::class, 'MaNCC', 'MaNCC');
    }
}
