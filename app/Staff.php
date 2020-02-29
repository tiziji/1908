<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table="staff";
    protected $primaryKey = "id";
    public $timestamps = false;
    //黑名单
    protected $guarded =[];
}