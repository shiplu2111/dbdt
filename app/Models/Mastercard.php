<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mastercard extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name','last_name','email','birth_day','country','address','city','zip_code','phone','username','password','id_country','id_type','id_number','bank_country','currency','bank_name','brunch_name','account_holder_name','account_number','status'
    ];
}
