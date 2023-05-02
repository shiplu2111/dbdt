<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teambonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'level1',
        'level2',
        'level3',
        'level4',
        'level5',
        'level6',
        'level7',
        'level8',
        'level9',
        'level10',
        'level11',
        'level12',
        'level1_id',
        'level2_id',
        'level3_id',
        'level4_id',
        'level5_id',
        'level6_id',
        'level7_id',
        'level8_id',
        'level9_id',
        'level10_id',
        'level11_id',
        'level12_id',
        'dev_fund',
    ];
}
