<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swap extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'prev_withdraw',
        'prev_staking',
        'amount',
        

    ];
}
