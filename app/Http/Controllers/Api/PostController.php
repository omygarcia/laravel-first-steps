<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\post\PutRequest;
use App\Http\Requests\post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::with('category')->paginate(10),200);
    }

    public function all()
    {
        // 1 - comprobar cache
        // 2 - Cache existe, devolver valor
        // 3 - Cache no existe, consulta BD - cache y retornar

        /*
        if(Cache::has('post_all')){
            return response()->json(Cache::get('post_all'));
        }else{
            $posts = Post::all();
            Cache::put('post_all',$posts);
            return response()->json($posts,200);
        }
        */

        return Cache::remember('post_all2',now()->addMinutes(10),function(){
            return Post::all();
        });
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

    public function upload(Request $request, Post $post)
    {
        $request->validate([
            'image'=>'required|mimes:jpg,png,gif|max:10240'
        ]);

        Storage::disk("public_upload")->delete("image/otro/".$post->image);

        $data["image"] = $filename = time().".".$request["image"]->extension();
        $request->image->move(public_path("image/otro"),$filename);

        $post->update($data);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return response()->json('sel eleiminaron: '.$post->delete().' registros',200);
    }
}
