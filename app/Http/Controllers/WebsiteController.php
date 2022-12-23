<?php

namespace App\Http\Controllers;

use App\Models\PlatForm;
use App\Models\Project;
use App\Models\Blog;
use App\Models\PlatformRating;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Datatables;

class WebsiteController extends Controller
{
    public function home(Request $request)
    {
        
         $platForm=PlatForm::orderby('capital_raised_to_date','desc')->limit(7)->get();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
        $blog= DB::select(DB::raw("SELECT *,b.id AS blog_id,b.created_at AS blog_created_at FROM blogs b INNER JOIN `users` u ON u.`id`=b.`user_id` WHERE b.`status`='active' ORDER BY b.`id` DESC LIMIT 3"));
        return view('website/website_home',compact('platForm','blog'));
    }
    public function homeProject(Request $request)
    {
        $currentOpen=$request->current_open;
        $added=$request->added;
        $funded=$request->funded;
        $notFunded=$request->not_funded;
        $fastestFundingPace=$request->fastest_funding_pace;
        $large=$request->large;
        $estateguru=$request->estateguru;
        $rendity=$request->rendity;
        $profitus=$request->profitus;
        $housers=$request->housers;
        $nordstreet=$request->nordstreet;
        $crowdestate=$request->crowdestate;
        //orderby('id','desc')->
        $project=Project::select(DB::raw("*,DATE_FORMAT(created_at, '%Y-%m-%d') AS created_ata"))
        ->when($currentOpen, function ($query, $currentOpen) {
            return $query->where('funding_status','in process');
        })
        ->when($added, function ($query, $added) {
            return $query->where('created_at', '>', date("Y-m-d", strtotime('this week')));
        })
        ->when($funded, function ($query, $funded) {
            return $query->where('funding_status','funded');
        })
        ->when($notFunded, function ($query, $notFunded) {
            return $query->where('funding_status','not funded');
        })
        ->when($estateguru, function ($query, $estateguru) {
            return $query->orWhere('plat_form','estateguru.co');
        })
        ->when($profitus, function ($query, $profitus) {
            return $query->orWhere('plat_form','profitus.com');
        })
        ->when($rendity, function ($query, $rendity) {
            return $query->orWhere('plat_form','rendity.com');
        })
        ->when($housers, function ($query, $housers) {
            return $query->orWhere('plat_form','housers.com');
        })
        ->when($nordstreet, function ($query, $nordstreet) {
            return $query->orWhere('plat_form','nordstreet.com');
        })
        ->when($crowdestate, function ($query, $crowdestate) {
            return $query->orWhere('plat_form','crowdestate.eu');
        })
        ->when($fastestFundingPace, function ($query, $fastestFundingPace) {
            return $query->orderby('funding_pace','ASC');
        })
        ->when($large, function ($query, $large) {
            return $query->orderby('average_ticket','desc');
        })
        ->limit(30)->get();

        return Datatables::of($project)
        ->addIndexColumn()
        ->make();
    }
    public function ProjectPage(Request $request)
    {
        $currentOpen=$request->current_open;
        $added=$request->added;
        $funded=$request->funded;
        $notFunded=$request->not_funded;
        $fastestFundingPace=$request->fastest_funding_pace;
        $large=$request->large;
        $estateguru=$request->estateguru;
        $rendity=$request->rendity;
        $profitus=$request->profitus;
        $housers=$request->housers;
        $nordstreet=$request->nordstreet;
        $crowdestate=$request->crowdestate;
        //orderby('id','desc')->
        $project=Project::select(DB::raw("*,DATE_FORMAT(created_at, '%Y-%m-%d') AS created_ata"))
        ->when($currentOpen, function ($query, $currentOpen) {
            return $query->where('funding_status','in process');
        })
        ->when($added, function ($query, $added) {
            return $query->where('created_at', '>', date("Y-m-d", strtotime('this week')));
        })
        ->when($funded, function ($query, $funded) {
            return $query->where('funding_status','funded');
        })
        ->when($notFunded, function ($query, $notFunded) {
            return $query->where('funding_status','not funded');
        })
        ->when($estateguru, function ($query, $estateguru) {
            return $query->orWhere('plat_form','estateguru.co');
        })
        ->when($profitus, function ($query, $profitus) {
            return $query->orWhere('plat_form','profitus.com');
        })
        ->when($rendity, function ($query, $rendity) {
            return $query->orWhere('plat_form','rendity.com');
        })
        ->when($housers, function ($query, $housers) {
            return $query->orWhere('plat_form','housers.com');
        })
        ->when($nordstreet, function ($query, $nordstreet) {
            return $query->orWhere('plat_form','nordstreet.com');
        })
        ->when($crowdestate, function ($query, $crowdestate) {
            return $query->orWhere('plat_form','crowdestate.eu');
        })
        ->when($fastestFundingPace, function ($query, $fastestFundingPace) {
            return $query->orderby('funding_pace','ASC');
        })
        ->when($large, function ($query, $large) {
            return $query->orderby('average_ticket','desc');
        })
        ;

        return Datatables::of($project)
        ->addIndexColumn()
        ->make();
    }
    public function platForm()
    {
        $platForm=PlatForm::orderby('capital_raised_to_date','desc')->get();
        $platformRating=PlatformRating::get();
        return view('website/website_plateform',compact('platForm','platformRating'));
    }
    public function platFormDetails($platFormName)
    {
        $platForm=PlatForm::where('plat_form',$platFormName)->orderby('capital_raised_to_date','desc')->get();
        return view('website/website_plateform_details',compact('platForm'));
    }
    
    public function project(Request $request)
    {
      
        return view('website/website_project');
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
    public function articleDetails($slug)
    {
        $blog= DB::select(DB::raw("SELECT *,b.id AS blog_id,b.created_at AS blog_created_at FROM blogs b INNER JOIN `users` u ON u.`id`=b.`user_id` WHERE b.`status`='active' ORDER BY b.`id` DESC LIMIT 3"));
        $blogDetails= DB::select(DB::raw("SELECT *,b.id AS blog_id,b.created_at AS blog_created_at FROM blogs b INNER JOIN `users` u ON u.`id`=b.`user_id` WHERE b.`status`='active' AND b.slug='$slug' ORDER BY b.`id` DESC "));
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
