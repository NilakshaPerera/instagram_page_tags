<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TempPost;
use App\Post;

class DashboardControler extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/dashboard');
    }

    public function loadSaved(Request $request)
    {

        $users = Post::select('username')->distinct()->get();
        $post = Post::orderBy('timestamp', 'DESC')
            ->get();

        $view = view('admin/insta-tiles')->with(['data' => $post, 'class' => 'insta-delete-selected', 'users' => $users ])->render();
        return response()->json([
            'success' => true,
            'data' =>  $view
        ]);
    }

    public function loadTemp(Request $request)
    {
        $users = TempPost::select('username')->distinct()->get();
        $tempPost = TempPost::orderBy('timestamp', 'DESC')->get();

        $view = view('admin/insta-tiles')->with(['data' => $tempPost, 'class' => 'insta-selected', 'users' => $users])->render();
        return response()->json([
            'success' => true,
            'data' =>  $view
        ]);
    }


    public function saveToPost(Request $request)
    {
        $selArray = explode(',',  $request['arr']);
        $data = TempPost::whereIn('id',  $selArray)->get();

        // Add on Post 
        foreach ($data as $item) {
            Post::create([
                'business_accounts_id' => $item->business_accounts_id,
                'postid' => $item->postid,
                'username' => $item->username,
                'caption' => $item->caption,
                'media_url' => $item->media_url,
                'like_count' => $item->like_count,
                'comments_count' => $item->comments_count,
                'media_type' => $item->media_type,
                'permalink' => $item->permalink,
                'timestamp' => $item->timestamp,
            ]);
        }

        // Remove on TempPost
        TempPost::destroy($selArray);

        return response()->json([
            'success' => true,
            'data' =>  $data
        ]);
    }

    public function deletePost(Request $request)
    {
        $selArray = explode(',',  $request['arr']);
        $data =  Post::whereIn('id',  $selArray)->get();

        // Add on TempPost
        foreach ($data as $item) {
            TempPost::create([
                'business_accounts_id' => $item->business_accounts_id,
                'postid' => $item->postid,
                'username' => $item->username,
                'caption' => $item->caption,
                'media_url' => $item->media_url,
                'like_count' => $item->like_count,
                'comments_count' => $item->comments_count,
                'media_type' => $item->media_type,
                'permalink' => $item->permalink,
                'timestamp' => $item->timestamp,
            ]);
        }

        // Remove on Post
        Post::destroy($selArray);

        return response()->json([
            'success' => true,
            'data' =>  $data
        ]);
    }
}
