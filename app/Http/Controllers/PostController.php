<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add.......
use App\Post;
use Validator;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $posts = Post::orderBy('id','desc')->get();
        return view('all_post',compact('posts'));
    }


    public function insert_post_method(Request $request)
    {
//        dd('ffore sid');

        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:50',
            'author' => 'required|max:30',
            'description' => 'required|max:150',
            'tags' => 'required|max:255',
        ]);


            $post = new Post();
            $post->title = $request->title;
            $post->author = $request->author;
            $post->description = $request->description;
            $post->tags = $request->tags;

            if($post->save())
            {
                $message = "Successfully inserted";
                $notification_array = array(
                    'message' => 'New Record insert successfully',
                    'alert-type' =>'success'
                );


                return back()->with($notification_array);
            }

    }

    public function update_post_method(Request $request,$id)
    {
//        dd('ffore sid');

        $validatedData = $request->validate([
            'title' => 'required|max:50',
            'author' => 'required|max:30',
            'description' => 'required|max:150',
            'tags' => 'required|max:255',
        ]);


        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->author = $request->author;
        $post->description = $request->description;
        $post->tags = $request->tags;

        if($post->save())
        {
            $message = "Successfully Updated";
            $notification_array = array(
                'message' => $message,
                'alert-type' =>'success'
            );


            return back()->with($notification_array);
        }

    }

    public function delete_info_method($id)
    {
        $delete = Post::find($id);
        if($delete->delete())
        {
            $message = "Successfully Deleted.. !!";
            $notification_array = array(
                'message' => $message,
                'alert-type' =>'info'
            );


            return back()->with($notification_array);
        }

//        dd($id);
    }









}
