<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gear extends Model
{
    protected $guarded = ['id', '_token'];
    public $timestamps = true;
}
