<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','withdraw_amount','withdraw_commission','withdraw_tax','withdraw_charge','withdraw_method','withdraw_method_address','withdraw_status','transaction_hash'
    ];
}
