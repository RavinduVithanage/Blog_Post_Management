<?php

namespace App\Http\Controllers;

use App\Mail\PostMail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;   
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Mail;

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
            "thumbnail" => ["required","image"],
        ],
        [
            'title.required' => 'The title is required.',
            'message.required' => 'The message is required.',
            'thumbnail.required'=> 'Thumbanail is Requirted',
            // Add more custom messages if needed
        ]);
        $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
    
        // $validatedData['user_id']= auth()->id();  
        // Post::create($validatedData);
        auth()->user()->posts()->create($validatedData);

        
         Mail::to(auth()->user()->email)->send(new PostMail(['name'=>'Tony','title'=>$validatedData['title']]));

        
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
        // if($post->user_id !== auth()->id()){
        //     abort('403');
        // }
        Gate::authorize('update', $post);
        return view("posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);
        $validatedData = $request->validate([
            "title" => ['required', 'string', 'min:5', 'max:255'],
            "message" => ['required', 'min:5'],
            "thumbnail" => ["sometimes","image"],
        ],
        [
            'title.required' => 'The title is required.',
            'message.required' => 'The message is required.',
            // 'thumbnail.required'=> 'Thumbanail is Requirted',
            // Add more custom messages if needed
        ]);
    
        if($request->hasFile('thumbnail')){
            File::delete(storage_path('app/public/' . $post->thumbnail));
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }
    
        $post->update($validatedData);
        return to_route('posts.show',['post'=>$post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        File::delete(storage_path('app/public/' . $post->thumbnail));
        $post->delete();
        return to_route('posts.index');
    }
}
