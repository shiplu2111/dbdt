<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'website_name','website_logo_path','website_fevIcon_path', 'website_slogan', 'website_footer_text', 'website_copy_write', 'tax'
    ];
}
