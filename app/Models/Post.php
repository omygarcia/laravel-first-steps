<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','content','image','category_id','image', 'description','posted'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
