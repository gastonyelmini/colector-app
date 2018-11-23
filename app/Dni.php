<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dni extends Model
{
    protected $fillable = ['dni', 'registed_by', 'name_lastname', 'address'];
}
