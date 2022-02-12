<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email'
    ];

    //relationship
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
