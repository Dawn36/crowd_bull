<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review= DB::select(DB::raw("SELECT r.`id`,r.`review_name`,u.`first_name`,u.`last_name`,r.`created_at` FROM `reviews` r INNER JOIN `users` u
        ON u.id=r.`user_id`  ORDER BY r.`id` DESC"));
        return view('review/review_index',compact('review'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('review/review_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $request->validate([
            'file' => ['required'],
            'review_name' => ['required','unique:reviews'],
            'description' => ['required'],
            'meta_title' => ['required'],
            'meta_description' => ['required'],
            'meta_keywords' => ['required'],
            'status' => ['required'],
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
                $file_name = time() . $file->getClientOriginalName();
                $size = $file->getSize();
                $destinationPath = base_path('public/uploads/reviewss/' . $userId);
                $file->move($destinationPath, $file_name);
                $path = 'uploads/reviewss/' . $userId . "/" . $file_name;

        }
        $user = Review::create([
            'user_id' => $userId,
            'status' =>$request->status,
            'review_thumbnail' => $path,
            'review_name' => strtolower($request->review_name),
            'slug' => Str::slug($request->review_name),
            'i_frame_link' => $request->i_frame_link,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'created_at' => Controller::currentDateTime(),
            'created_by' => $userId,

        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $review=Review::find($id);
        $userId=$review->user_id;
        $categoriesId=$review->categories_id;
        $user=User::find($userId);
       

        return view('review/review_show',compact('review','user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $review=Review::find($id);
        return view('review/review_edit',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $userId = Auth::user()->id;

        $request->validate([
            'review_name' => ['required','unique:reviews,review_name,'.$id],
            'description' => ['required'],
            'meta_title' => ['required'],
            'meta_description' => ['required'],
            'meta_keywords' => ['required'],
            'status' => ['required'],
        ]);
        $review = Review::find($id);
        
        
        $review['status'] = $request->status;
        $review['review_name'] = strtolower($request->review_name);
        $review['slug'] =  Str::slug($request->review_name);
        $review['i_frame_link'] = $request->i_frame_link;
        $review['description'] = $request->description;
        $review['meta_title'] = $request->meta_title;
        $review['meta_description'] = $request->meta_description;
        $review['meta_keywords'] = $request->meta_keywords;
        $review['updated_by'] = Auth::user()->id;
        $review['updated_at'] = date("Y-m-d");
        $review->save();


        if ($request->hasFile('file')) {
            $folderName = $id;
            $fileName = time();
            $previousPic = $review->review_thumbnail;
            $previousPicDest =  $previousPic;
            File::delete($previousPicDest);


            $path = "uploads/reviewss/" . $userId;
            $file = $request->file('file');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            $review['review_thumbnail'] = $path . "/" . $filename;

            $review->save();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $data = Review::find($id);
        $data->delete();
        return redirect()->back();
    }
}
