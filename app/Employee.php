<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'detail','nic','basic','allowance','gross','epf','net'
    ];
}
