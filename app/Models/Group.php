<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "groups";
    protected $fillable = [
        'name',
        'slug',
        'plan_id',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
