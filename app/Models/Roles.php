<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['quyen'];

    protected $primaryKey='id_quyen';

    protected $table='quyen';

    public function staff(){
    	return $this->belongsToMany('App\Models\Staff', 'cap_quyen', 'id_quyen', 'MSNV');
    }
}
