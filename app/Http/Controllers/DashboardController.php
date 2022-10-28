<?php

namespace App\Http\Controllers;

use App\Models\PlatForm;
use App\Models\Blog;
use App\Models\Project;


class DashboardController extends Controller
{
    public function dashboard()
    {
       $platForm=PlatForm::count();
       $project=Project::count();
       $blog=Blog::count();
        return view('dashboard',compact('platForm','project','blog'));
    }
   
}
