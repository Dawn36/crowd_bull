<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog= DB::select(DB::raw("SELECT b.`id`,b.`blog_name`,u.`first_name`,u.`last_name`,b.`created_at` FROM `blogs` b INNER JOIN `users` u
        ON u.id=b.`user_id`  ORDER BY b.`id` DESC"));
        return view('blog/blog_index',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog/blog_create');
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
            'blog_name' => ['required','unique:blogs'],
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
                $destinationPath = base_path('public/uploads/blogss/' . $userId);
                $file->move($destinationPath, $file_name);
                $path = 'uploads/blogss/' . $userId . "/" . $file_name;

        }
        
        
        $user = Blog::create([
            'user_id' => $userId,
            'status' =>$request->status,
            'blog_thumbnail' => $path,
            'blog_name' => strtolower($request->blog_name),
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $blog=Blog::find($id);
        $userId=$blog->user_id;
        $categoriesId=$blog->categories_id;
        $user=User::find($userId);
       

        return view('blog/blog_show',compact('blog','user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $blog=Blog::find($id);
        return view('blog/blog_edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $userId = Auth::user()->id;

        $request->validate([
            'blog_name' => ['required','unique:blogs,blog_name,'.$id],
            'description' => ['required'],
            'meta_title' => ['required'],
            'meta_description' => ['required'],
            'meta_keywords' => ['required'],
            'status' => ['required'],
        ]);
        $blog = Blog::find($id);
        
        
        $blog['status'] = $request->status;
        $blog['blog_name'] = strtolower($request->blog_name);
        $blog['i_frame_link'] = $request->i_frame_link;
        $blog['description'] = $request->description;
        $blog['meta_title'] = $request->meta_title;
        $blog['meta_description'] = $request->meta_description;
        $blog['meta_keywords'] = $request->meta_keywords;
        $blog['updated_by'] = Auth::user()->id;
        $blog['updated_at'] = date("Y-m-d");
        $blog->save();


        if ($request->hasFile('file')) {
            $folderName = $id;
            $fileName = time();
            $previousPic = $blog->blog_thumbnail;
            $previousPicDest =  $previousPic;
            File::delete($previousPicDest);


            $path = "uploads/blogss/" . $userId;
            $file = $request->file('file');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            $blog['blog_thumbnail'] = $path . "/" . $filename;

            $blog->save();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $data = Blog::find($id);
        $data->delete();
        return redirect()->back();
    }
   
}
