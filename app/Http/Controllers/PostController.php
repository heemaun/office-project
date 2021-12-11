<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('writer')->only('create','store');
        $this->middleware('editor')->only('edit','update');
        $this->middleware('admin')->only('destroy');
    }

    public function index()
    {
        $posts = Post::all();
        return route('home',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:10|max:100',
            'body' => 'required|min:100|max:100000'
        ]);

        if($validated){
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->user_id = auth()->user()->id;
            $post->slug = $this->slugMaker($request->title,0);
            $post->save();
            return redirect(route('home'))->with('post_added','Post added successfully');
            // return session('post_added');
        }
        else{
            return back()->with('');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('view-post',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('edit-post',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|min:10|max:100',
            'body' => 'required|min:100|max:100000'
        ]);
        if($validated){
            $post = Post::find($post->id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();
            return redirect(route('posts.show',$post->slug))->with('post_updated','Post updated successfully');
        }
        else{
            return back()->with('');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('home'))->with('post_deleted','Post deleted successfully');
    }


    //custom build method to generate slug
    public function slugMaker($slug,$num)
    {
        $slug = Str::slug($slug);
        $posts = Post::get()->where('slug',$slug);
        if(count($posts) > 0){
            if($num > 0){
                $slug = substr($slug, 0, -2);
            }
            $num++;
            $slug = $slug . '-' . $num;
            return $this->slugMaker($slug,$num);
        }
        return $slug;
    }
}
