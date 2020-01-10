<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    protected $table = "users_contacts";
    protected $fillable = [
        'user_id',
        'zipcode',
        'address',
        'number',
        'district',
        'city',
        'state',
        'phone',
        'cell'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
