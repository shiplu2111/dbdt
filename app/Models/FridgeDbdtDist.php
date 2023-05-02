<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FridgeDbdtDist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','package_id','order_id','dbdt_amount','dbdt_amount_per_period','distribute_dbdt_amount','period','status',
    ];
}