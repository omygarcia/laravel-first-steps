<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\post\PutRequest;
use App\Http\Requests\post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::paginate(10);
        return response()->json($data, 200);
    }

    public function all()
    {
        $data = Category::get();
        return response()->json($data, 200);
    }

    public function slug($slug)
    {
        $category = Category::where("slug",$slug)->firstOrFail();
        return response()->json($category);
    }

    public function posts(Category $category)
    {
        /*$posts = Post::join('categories','posts.category_id','=','categories.id')
                ->select('posts.*',"categories.title as category")
                ->where('categories.id','=',$category->id)
                //->toSql();
                ->get();
          */
          
        $posts = Post::with("category")
        ->where("posts.category_id",$category->id)
        ->get();

        return response()->json($posts,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //dd($request);
        return response()->json(Category::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return Response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->deleteOrFail();
        return response()->json(['msg'=>'categoria eliminada'],200);
    }
}
