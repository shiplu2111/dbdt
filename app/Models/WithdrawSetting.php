<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'pack_value_withdraw_status','commission_withdraw_status', 'withdraw_commission', 'withdraw_tax', 'withdraw_charge'
    ];
}
