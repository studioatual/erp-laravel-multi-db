<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    protected $table = "customers_contacts";
    protected $fillable = [
        'customer_id',
        'zipcode',
        'address',
        'number',
        'district',
        'city',
        'state',
        'phone',
        'cell'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
