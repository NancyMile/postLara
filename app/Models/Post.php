<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable =['title', 'content','category_id'];

    public function categoy(){
        return $this->belongsTo(Category::class);
    }
}