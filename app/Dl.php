<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dl extends Model
{
    protected $table="dl";
    protected $primaryKey="id";
    public $timestamps=false;
    protected $guarded =[];
}
}
