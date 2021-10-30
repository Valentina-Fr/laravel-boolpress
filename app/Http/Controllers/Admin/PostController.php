<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function create()
    {   
        $post = new Post;
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
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
            'tags' => 'nullable|exists:tags,id',
            'image' =>  'nullable|mimes:jpeg,png,jpg,gif,svg'
        ], [
            'required' => 'You must fill the :attribute field',
            'min' => 'The field :attribute must be at least :min characters',
            'max' => 'The field :attribute can\'t be longer than :max characters',
            'image.mimes' => 'The file must be an image of type: :jpeg, png, jpg, gif, svg'
        ]);

        $data = $request->all();
        $post = new Post();
        $data['user_id'] = Auth::id();
        if(array_key_exists('image', $data)) {
            $image_path = Storage::put('post_images', $data['image']);
            $data['image'] = $image_path;
        }
        $post->fill($data);
        $post->save();
        //creo relazione con tags
        if(array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);
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
    public function edit(Post $post)
    {   
        $categories = Category::all();
        $tags = Tag::all();
        $tagIds = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'tagIds')); 
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
            'tags' => 'nullable|exists:tags,id', 
            'image' => 'nullable|mimes:mimes:jpeg,png,jpg,gif,svg'
        ], [
            'required' => 'You must fill the :attribute field',
            'min' => 'The field :attribute must be at least :min characters',
            'max' => 'The field :attribute can\'t be longer than :max characters',
            'image.mimes' => 'The file must be an image of type: :jpeg, png, jpg, gif, svg'
        ]);

        $data = $request->all();
        if(!array_key_exists('tags', $data)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);
        if(array_key_exists('image', $data)) {
            if($post->image) Storage::delete($post->image);
            $image_path = Storage::put('post_images', $data['image']);
            $data['image'] = $image_path;
        }
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
        if(count($post->tags)) $post->tags()->detach();
        if($post->image) Storage::delete($post->image);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('alert-type', 'success')->with('alert-message', 'Message deleted!');
    }
}
