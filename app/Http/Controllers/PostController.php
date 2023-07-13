<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostFormRequest;
class PostController extends Controller
{
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $request->validated();
        $post = new Post();
       Post:: create ([
        'title'=> $request->input('title'),
        'description'=> $request->input('description')
       ]);
         return redirect() 
        ->route('posts.create')
        ->with('success', 'Post is submitted! Title: '.
        $post->title.' Description: '.
        $post->description);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', [
            'post' => Post::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', [
            'post' => Post::findOrFail($id),
        ]);
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
        $request->validated();
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
        return redirect() 
        ->route('posts.show', ['post'=> $post->id])
        ->with('success', 'Post is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
    
        return redirect()
            ->route('home')
            ->with('success', 'Post Eliminated');
               
    }
}
