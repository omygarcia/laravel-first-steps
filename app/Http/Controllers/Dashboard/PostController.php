<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\post\PutRequest;
use App\Http\Requests\post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //formas de redirigir
        //return to_route('post.create');
        //return redirect('/post/create');
        
        $posts = Post::paginate(2);
        return view('dashboard.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$categories = Category::get();
        $categories = Category::pluck('id','title');

        $post = new Post();
        //dd($categories);
        return view('dashboard.post.create',compact('categories','post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest /*Request*/ $request)
    {
        //dd($request);
        /*
        $validated = $request->validate([
            "title"         =>  "required|min:5|max:500",
            "slug"          =>  "required|min:5|max:500",
            "content"       =>  "required|min:7",
            "category_id"   =>  "required|integer",
            "description"   =>  "required|min:7",
            "posted"        =>  "required",
        ]);
        */

        //dd($validated);

        /*$validator = Validator::make($request->all(),[
            "title"         =>  "required|min:5|max:500",
            "slug"          =>  "required|min:5|max:500",
            "content"       =>  "required|min:7",
            "category_id"   =>  "required|integer",
            "description"   =>  "required|min:7",
            "posted"        =>  "required",
        ],[
            "title"=>[
                'required'=>'El titulo es obligatorio',
                'min'=>'El titulo debe contener al menos 5 caracteres',
                'max'=>'El titulo debe contener máximo 500 caracteres',
            ],
        ]);

        $validator->validate();
        */

        $data = array_merge($request->all(),['image'=>'']);
        Post::create($data);
        return to_route('post.index')->with('status', 'Registro creado con exito!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::pluck('id','title');
        $post = Post::find($id);
        return view('dashboard.post.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        //dd($request);
        //$post->update($request->validated());

        if(isset($request->validated()['image']) && $request->validated()['image'])
        {
            //dd($request->validated()['image']->extension());
            $filename = time().".".$request->validated()['image']->extension();

            $request->validated()['image']->move(public_path("image"),$filename);
        }

         //->flash('status','Registro actualizado con exito!');
        //$request->session()->flash('status', 'Registro actualizado con exito!');
        return to_route('post.index')->with('status', 'Registro actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //return "DELETE ".$id;
        $post->delete();
        return redirect('/')->with('status', 'Registro eliminado correctamente');
    }
}
