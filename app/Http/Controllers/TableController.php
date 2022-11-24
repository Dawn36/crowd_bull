<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function crowdestate()
    {   
        $project=DB::table('CrowdestateNew')->orderby('id','desc')->limit(1000)->get();
        return view('table/crowdestate',compact('project'));
    }
    public function estateguru()
    {   
        $project=DB::table('EstateguruNew')->orderby('id','desc')->limit(1000)->get();
        return view('table/estateguru',compact('project'));
    }
    public function housers()
    {   
        $project=DB::table('HousersNew')->orderby('id','desc')->limit(1000)->get();
        return view('table/housers',compact('project'));
    }
    public function nordstreet()
    {   
        $project=DB::table('NordstreetNew')->orderby('id','desc')->limit(1000)->get();
        return view('table/nordstreet',compact('project'));
    }
    public function profitus()
    {   
        $project=DB::table('ProfitusNew')->orderby('id','desc')->limit(1000)->get();
        return view('table/profitus',compact('project'));
    }
    public function rendity()
    {   
        $project=DB::table('RendityNew')->orderby('id','desc')->limit(1000)->get();
        return view('table/rendity',compact('project'));
    }
}
