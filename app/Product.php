<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'purchase_price', 'sale_price', 'gain', 'quantity', 'type', 'state', 'url_photo',
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function states()
    {
        return $this->belongsTo(State::class);
    }

    public function types()
    {
        return $this->belongsTo(Type::class);
    }
}
