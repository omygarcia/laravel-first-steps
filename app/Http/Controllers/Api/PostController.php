<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\post\PutRequest;
use App\Http\Requests\post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::paginate(2),200);
    }

    public function all()
    {
        return response()->json(Post::get(),200);
    }


    /*
    public function slug($slug)
    {
        $post = Post::with("category")->where("slug",$slug)->firstOrFail();
        return response()->json($post);
    }
    */

    //segunda forma para buscar slug
    public function slug(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Post::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        return response()->json( $post->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return response()->json('sel eleiminaron: '.$post->delete().' registros',200);
    }
}
