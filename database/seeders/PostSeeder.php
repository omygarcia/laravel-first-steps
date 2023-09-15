<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB ::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for($i=0;$i<30;$i++)
        {
            $c = Category::inRandomOrder()->first();

            $title = Str::random(20);
            Post::create([
                'title'=>$title,
                'slug'=>Str::slug($title),
                'content'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, voluptatem minus eius nulla reprehenderit optio excepturi ipsam dignissimos commodi voluptatibus ducimus eveniet quibusdam qui facilis sunt quis placeat recusandae!",
                'category_id'=>$c->id,
                'image'=>'',
                'description'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                'posted'=>'yes',
            ]);
        }
    }
}
