<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = ['id', '_token', 'files'];
    public $timestamps = true;

    public function productCart()
    {
        return $this->belongsTo(ProductCart::class, 'sub_category_id');
    }
}
