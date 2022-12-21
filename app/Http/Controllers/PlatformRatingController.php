<?php

namespace App\Http\Controllers;

use App\Models\PlatformRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PlatformRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $platformRating= PlatformRating::get();
        return view('plat-form-rating/plat_form_rating_index',compact('platformRating'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plat-form-rating/plat_form_rating_create');
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
            
        ]);
        $userId=Auth::user()->id;
        $path='';
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
                $file_name = time() . $file->getClientOriginalName();
                $size = $file->getSize();
                $destinationPath = base_path('public/uploads/platformsrating/' . $userId);
                $file->move($destinationPath, $file_name);
                $path = 'uploads/platformsrating/' . $userId . "/" . $file_name;

        }
        $data = PlatformRating::create([
            'platform_name' => $request->platform_name,
            'score' => $request->stars,
            'description' => $request->description,
            'minimum_ticket' => $request->minimum_ticket,
            'path' => $path,
            'user_id' => $userId,
            'created_at' => Date("Y-m-d"),
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlatformRating  $platformRating
     * @return \Illuminate\Http\Response
     */
    public function show(PlatformRating $platformRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlatformRating  $platformRating
     * @return \Illuminate\Http\Response
     */
    public function edit(PlatformRating $platformRating)
    {
        return view('plat-form-rating/plat_form_rating_edit',compact('platformRating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlatformRating  $platformRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $userId=Auth::user()->id;

        $request->validate([
            'platform_name' => ['required'],
        ]);
        $adds = PlatformRating::find($id);
        $adds['platform_name'] = $request->platform_name;
        $adds['score'] = $request->stars;
        $adds['description'] = $request->description;
        $adds['minimum_ticket'] = $request->minimum_ticket;
        $adds->save();

        if ($request->hasFile('avatar')) {
            File::delete($adds->path);
            $path = "uploads/platformsrating/" . $userId;
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            $adds['path'] = $path . "/" . $filename;

            $adds->save();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlatformRating  $platformRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $data = PlatformRating::find($id);
        $data->delete();
        return redirect()->back();
    }
}
