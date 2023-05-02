<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id','user_id', 'order_id','subtotal','tax','status','pay_code'
    ];
}
