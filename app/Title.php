<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table="title";
    protected $primaryKey="t_id";
    public $timestamps=false;
    protected $guarded =[];
}
