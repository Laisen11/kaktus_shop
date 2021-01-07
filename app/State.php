<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name',
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
