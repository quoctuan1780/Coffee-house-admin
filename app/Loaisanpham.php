<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loaisanpham extends Model
{
    protected $table = "loaisanpham";

    public function sanpham(){
        return $this->hasMany('App\Sanpham', 'maloaisp', 'maloaisp');
    }
}
