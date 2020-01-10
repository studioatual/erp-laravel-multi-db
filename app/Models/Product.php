<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = [
        'group_id',
        'price',
        'width',
        'height',
        'depth',
        'weight',
        'description',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
