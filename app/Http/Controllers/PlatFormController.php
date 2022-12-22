<?php

namespace App\Http\Controllers;

use App\Models\PlatForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class PlatFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $talkTrack=TalkTrack::with('user')->get();
        $platForm= PlatForm::get();
        return view('plat-form/plat_form_index',compact('platForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plat-form/plat_form_create');
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
            'plat_form' => ['required'],
            
        ]);
        $userId=Auth::user()->id;
        $path='';
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
                $file_name = time() . $file->getClientOriginalName();
                $size = $file->getSize();
                $destinationPath = base_path('public/uploads/platforms/' . $userId);
                $file->move($destinationPath, $file_name);
                $path = 'uploads/platforms/' . $userId . "/" . $file_name;

        }
        $data = PlatForm::create([
            'plat_form' => $request->plat_form,
            'capital_raised_to_date' => $request->capital_raised_to_date,
            'avg_interest_rate' => $request->avg_interest_rate,
            'no_of_project_funded' => $request->no_of_project_funded,
            'no_of_project_not_funded' => $request->no_of_project_not_funded,
            'no_of_project_open' => $request->no_of_project_open,
            'no_of_investors' => $request->no_of_investors,
            'avg_ticket_size' => $request->avg_ticket_size,
            'raised_in_past_30_days' => $request->raised_in_past_30_days,
            'raised_in_past_7_days' => $request->raised_in_past_7_days,
            'plat_form_image' => $path,
            'url' => $request->url,
            'raised_in_the_past_30_days_status' => $request->raised_in_the_past_30_days_status,
            'raised_in_the_past_30_days_percentage' => $request->raised_in_the_past_30_days_percentage,
            'raised_this_week_percentage' => $request->raised_this_week_percentage,
            'raised_this_week_status' => $request->raised_this_week_status,
            'description' => $request->description,
            'created_at' => Controller::currentDateTime(),
            'created_by' => Auth::user()->id,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TalkTrack  $talkTrack
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TalkTrack  $talkTrack
     * @return \Illuminate\Http\Response
     */
    public function edit(PlatForm $platForm)
    {
        return view('plat-form/plat_form_edit',compact('platForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TalkTrack  $talkTrack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $userId=Auth::user()->id;

        $request->validate([
            'plat_form' => ['required'],
        ]);
        $adds = PlatForm::find($id);
        $adds['plat_form'] = $request->plat_form;
        $adds['capital_raised_to_date'] = $request->capital_raised_to_date;
        $adds['avg_interest_rate'] = $request->avg_interest_rate;
        $adds['no_of_project_funded'] = $request->no_of_project_funded;
        $adds['no_of_project_not_funded'] = $request->no_of_project_not_funded;
        $adds['no_of_project_open'] = $request->no_of_project_open;
        $adds['no_of_investors'] = $request->no_of_investors;
        $adds['avg_ticket_size'] = $request->avg_ticket_size;
        $adds['raised_in_past_30_days'] = $request->raised_in_past_30_days;
        $adds['raised_in_past_7_days'] = $request->raised_in_past_7_days;
        $adds['description'] = $request->description;
        $adds['raised_in_the_past_30_days_percentage'] = $request->raised_in_the_past_30_days_percentage;
        $adds['raised_in_the_past_30_days_status'] = $request->raised_in_the_past_30_days_status;
        $adds['raised_this_week_percentage'] = $request->raised_this_week_percentage;
        $adds['raised_this_week_status'] = $request->raised_this_week_status;
        $adds['url'] = $request->url;
        $adds['updated_by'] = Auth::user()->id;
        $adds['updated_at'] = Controller::currentDateTime();
        $adds->save();

        if ($request->hasFile('avatar')) {
            $folderName = $id;
            $fileName = time();
            $previousPic = $adds->plat_form_image;
            $previousPicDest =  $previousPic;
            File::delete($previousPicDest);


            $path = "uploads/platforms/" . $userId;
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            $adds['plat_form_image'] = $path . "/" . $filename;

            $adds->save();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TalkTrack  $talkTrack
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $data = PlatForm::find($id);
        $data->delete();
        return redirect()->back();
    }
}
