<?php

namespace App\Http\Controllers\Dashborad;

use Illuminate\Http\Request;
use App\Models\User;
use  App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index(){
        $data = [
            "name"=>"Omar García",
            "age"=>18,
            "html"=>"<h1>Titulo</h1>",
            "arr"=>[1,2,3,4,5,"re"],
        ];
        return view("dashboard.test.index",$data);
    }

    public function test(){
        $user = User::find(1);
        dd($user);
        echo "Hola mundo";
    }
}
