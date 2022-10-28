<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','categories_id','blog_thumbnail','blog_name','i_frame_link', 'status', 'description','alt_tag',
        'meta_title', 'meta_description', 'meta_keywords', 'created_at', 'created_by','updated_at','updated_by',
    ];
}
