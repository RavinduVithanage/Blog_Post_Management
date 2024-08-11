<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminPostController extends Controller
{
    //
    public function edit(Post $post){

        return view("admin.posts.edit", compact("post"));

    }
    public function update(Request $request, Post $post){

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
        return to_route('admin.index',['post'=>$post]);
    }
    public function destroy(Post $post){

        $post->delete();
        return to_route('admin.index');

    }
}
