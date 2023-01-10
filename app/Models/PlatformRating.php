<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformRating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','platform_name','score', 'description','minimum_ticket','created_at','updated_ay','path','more_info_url','register_url'
    ];
}
