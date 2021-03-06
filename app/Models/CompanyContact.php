<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    protected $table = "companies_contacts";
    protected $fillable = [
        'company_id',
        'zipcode',
        'address',
        'number',
        'district',
        'city',
        'state',
        'phone',
        'cell'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
