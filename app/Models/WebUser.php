<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebUser extends Model
{
    protected $guarded = ['id', '_token'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'address', 'tel', 'password', 'remember_token',
    ];

    public function productCarts()
    {
        return $this->hasMany(ProductCart::class, 'id');
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class, 'id');
    }
}
