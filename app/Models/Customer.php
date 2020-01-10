<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    protected $fillable = [
        'group_id',
        'company',
        'name',
        'cpf_cnpj',
        'rg_ie',
    ];

    public function contacts()
    {
        return $this->hasMany(CustomerContact::class);
    }
}
