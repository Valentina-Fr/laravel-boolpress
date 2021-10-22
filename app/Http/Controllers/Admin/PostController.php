<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = Category::all();
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {   
        $post = new Post;
        $categories = Category::all();
        return view('admin.posts.create', compact('post', 'categories'));
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
            'title' => 'required|min:3|max:50',
            'article' => 'required|min:10',
        ], [
            'required' => 'You must fill the :attribute field',
            'min' => 'The field :attribute must be at least :min characters',
            'max' => 'The field :attribute can\'t be longer than :max characters'
        ]);

        $data = $request->all();
        $post = new Post();
        $data['user_id'] = Auth::id();
        $post->fill($data);
        $post->save();
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Category $category)
    {   
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'article' => 'required|min:10',
        ], [
            'required' => 'You must fill the :attribute field',
            'min' => 'The field :attribute must be at least :min characters',
            'max' => 'The field :attribute can\'t be longer than :max characters'
        ]);

        $data = $request->all();
        $post->update($data);
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
