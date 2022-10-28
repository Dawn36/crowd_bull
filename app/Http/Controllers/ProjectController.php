<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project=Project::get();
        return view('project/project_index',compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project/project_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'platform_name' => ['required'],
            'project_name' => ['required'],
            'goal' => ['required'],
            'duration_months' => ['required'],
            'interest' => ['required'],
            'ltv' => ['required'],
            'raised_to_date' => ['required'],
            'funding_progress' => ['required'],
            'investors' => ['required'],
            'avg_ticket' => ['required'],
            'status' => ['required'],
        ]);

        $data = Project::create([
            'plat_form' => $request->platform_name,
            'project_name' => $request->project_name,
            'goal' => $request->goal,
            'duration_month' => $request->duration_months,
            'interest' => $request->interest,
            'ltv' => $request->ltv,
            'raised_to_date' => $request->raised_to_date,
            'funding_progress' => $request->funding_progress,
            'investors' => $request->investors,
            'average_ticket' => $request->avg_ticket,
            'funding_pace' => $request->funding_pace,
            'date_added' => Controller::currentDateTime(),
            'funding_status' => $request->status,
            'url' => $request->url,
            'created_at' => Controller::currentDateTime(),
            'created_by' => Auth::user()->id,
        ]);
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(Project $emailTemplate)
    {
        // return view('email-template/email_template_show',compact('emailTemplate'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('project/project_edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {
        $request->validate([
            'platform_name' => ['required'],
            'project_name' => ['required'],
            'goal' => ['required'],
            'duration_months' => ['required'],
            'interest' => ['required'],
            'ltv' => ['required'],
            'raised_to_date' => ['required'],
            'funding_progress' => ['required'],
            'investors' => ['required'],
            'avg_ticket' => ['required'],
            'status' => ['required'],
        ]);
        $adds = Project::find($id);
        $adds['plat_form'] = $request->platform_name;
        $adds['project_name'] = $request->project_name;
        $adds['goal'] = $request->goal;
        $adds['duration_month'] = $request->duration_months;
        $adds['interest'] = $request->interest;
        $adds['ltv'] = $request->ltv;
        $adds['raised_to_date'] = $request->raised_to_date;
        $adds['funding_progress'] = $request->funding_progress;
        $adds['investors'] = $request->investors;
        $adds['average_ticket'] = $request->avg_ticket;
        $adds['funding_pace'] = $request->funding_pace;
        $adds['average_ticket'] = $request->avg_ticket;
        $adds['funding_status'] = $request->status;
        $adds['url'] = $request->url;
        $adds['updated_by'] = Auth::user()->id;
        $adds['updated_at'] = Controller::currentDateTime();
        $adds->save();
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $data = Project::find($id);
        $data->delete();
        return redirect()->back();
    }
}
