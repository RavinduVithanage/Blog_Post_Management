<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();        
        return view("posts.index",["posts"=> $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "title" => ['required', 'string', 'min:5', 'max:255'],
            "message" => ['required', 'min:5'],
        ]);

        // $validatedData['user_id']= auth()->id();  
        // Post::create($validatedData);

        auth()->user()->posts()->create($validatedData);
        // return redirect()->route("posts.index");
        


     
         return to_route("posts.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // $post = Post::findOrFail($id);
        return view("posts.show",["post"=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if($post->user_id !== auth()->id()){
            abort('403');
        }
        return view("posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            "title" => ['required', 'string', 'min:5', 'max:255'],
            "message" => ['required', 'min:5'],
        ],
        [
            'title.required' => 'The title is required.',
            'message.required' => 'The message is required.',
            // Add more custom messages if needed
        ]);
    
        $post->update($validatedData);
        return to_route('posts.show',['post'=>$post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('posts.index');
    }
}
