<?php

namespace App\Http\Controllers;

use App\Models\PlatForm;
use App\Models\Project;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home(Request $request)
    {
        
        
            $platForm=PlatForm::orderby('capital_raised_to_date','desc')->limit(7)->get();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if($request->current_open == 'fastest_funding_pace')
        {
            $project=Project::orderby('funding_pace','ASC')->limit(30)->get();
        }
        elseif($request->current_open == 'added')
        {
            $project=Project::where('created_at', '>', date("Y-m-d", strtotime('this week')))->orderby('id','desc')->limit(30)->get();
        }
        elseif($request->current_open == 'large')
        {
            $project=Project::orderby('average_ticket','desc')->limit(30)->get();
        }
        elseif($request->current_open == 'current_open')
        {
            $project=Project::orderby('id','desc')->where('funding_status','in process')->limit(30)->get();
        }
        else
        {
            $project=Project::orderby('id','desc')->limit(30)->get();
        }
        
        $blog= DB::select(DB::raw("SELECT *,b.id AS blog_id,b.created_at AS blog_created_at FROM blogs b INNER JOIN `users` u ON u.`id`=b.`user_id` WHERE b.`status`='active' ORDER BY b.`id` DESC LIMIT 3"));
        return view('website/website_home',compact('platForm','project','blog'));
    }
    public function platForm()
    {
        $platForm=PlatForm::orderby('capital_raised_to_date','desc')->get();
        return view('website/website_plateform',compact('platForm'));
    }
    public function platFormDetails($id)
    {
        $platForm=PlatForm::where('id',$id)->orderby('capital_raised_to_date','desc')->get();
        return view('website/website_plateform_details',compact('platForm'));
    }
    
    public function project(Request $request)
    {
        if($request->current_open == 'fastest_funding_pace')
        {
            $project=Project::orderby('funding_pace','ASC')->get();
        }
        elseif($request->current_open == 'added')
        {
            $project=Project::where('created_at', '>', date("Y-m-d", strtotime('this week')))->orderby('id','desc')->get();
        }
        elseif($request->current_open == 'large')
        {
            $project=Project::orderby('average_ticket','desc')->get();
        }
        elseif($request->current_open == 'current_open')
        {
            $project=Project::orderby('id','desc')->where('funding_status','in process')->get();
        }
        else
        {
            $project=Project::orderby('id','desc')->get();
        }
        return view('website/website_project',compact('project'));
    }
    public function articles()
    {
        $blog= DB::select(DB::raw("SELECT *,b.id AS blog_id,b.created_at AS blog_created_at FROM blogs b INNER JOIN `users` u ON u.`id`=b.`user_id` WHERE b.`status`='active' ORDER BY b.`id` DESC"));

        return view('website/website_articles',compact('blog'));
    }
    public function aboutUs()
    {
        return view('website/website_about_us');
    }
    public function privacyPolicy()
    {
        return view('website/website_privacy_policy');
    }
    public function adPolicy()
    {
        return view('website/website_ad_policy');
    }
    public function articleDetails($id)
    {
        $blog= DB::select(DB::raw("SELECT *,b.id AS blog_id,b.created_at AS blog_created_at FROM blogs b INNER JOIN `users` u ON u.`id`=b.`user_id` WHERE b.`status`='active' ORDER BY b.`id` DESC LIMIT 3"));
        $blogDetails= DB::select(DB::raw("SELECT *,b.id AS blog_id,b.created_at AS blog_created_at FROM blogs b INNER JOIN `users` u ON u.`id`=b.`user_id` WHERE b.`status`='active' AND b.id='$id' ORDER BY b.`id` DESC "));
        return view('website/website_article_single',compact('blog','blogDetails'));
    }
    public static function header()
    {
        $platFormCount=PlatForm::count();
        $project=Project::count();
        $capital=DB::select(DB::raw("SELECT SUM(goal) AS capital FROM `projects` WHERE funding_status='funded'"));
        $data=array('platFormCount'=>$platFormCount,'project'=>$project,'capital'=>$capital[0]->capital);
        return $data;
    }
    public static function footer()
    {
        $blog=Blog::orderby('id','desc')->limit(5)->get();
        $platForm=PlatForm::orderby('id','desc')->limit(7)->get();
        $data=array('blog'=>$blog,'platForm'=>$platForm);
        return $data;
    }
    
}
