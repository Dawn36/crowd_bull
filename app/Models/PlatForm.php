<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PlatForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'plat_form','capital_raised_to_date','avg_interest_rate', 'no_of_project_funded', 'no_of_project_not_funded','no_of_project_open','no_of_investors',
        'avg_ticket_size','status','percentage','raised_in_past_30_days','raised_in_past_7_days','plat_form_image','description','created_at','created_by','updated_at','updated_by','url'
    ];
    protected $table = 'plat_form';
}
