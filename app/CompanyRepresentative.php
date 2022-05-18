<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRepresentative extends Model
{
    protected $fillable = ['user_id','representative_option','company_id','slug'];
}
