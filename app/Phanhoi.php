<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Phanhoi extends Model
{
    protected $table = 'phanhoi';

    public static function getAll(){
        $phanhoi = DB::table('phanhoi')->get();
        return $phanhoi;
    }

    public static function xoaphanhoi($maph){
        DB::table('phanhoi')->where('maph', '=', $maph)->delete();
        return true;
    }
}
