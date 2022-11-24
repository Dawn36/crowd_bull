<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'plat_form','project_name','goal','duration_month', 'interest', 'ltv','raised_to_date','funding_progress','comment','loan_type','remaining_to_rise'
        , 'investors','average_ticket','funding_pace','date_added','funding_status','url','created_at','updated_at','created_by','updated_by'
    ];

   
}
