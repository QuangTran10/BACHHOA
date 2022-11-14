<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['Ten', 'Email', 'DiaChi', 'SDT'];

    protected $primaryKey='MaNSX';

    protected $table='nhasanxuat';
}
