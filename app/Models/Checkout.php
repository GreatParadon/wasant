<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $guarded = ['id', '_token'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(WebUser::class, 'user_id');
    }
}
