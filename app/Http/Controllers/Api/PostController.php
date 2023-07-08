<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(){
        // this resource is a wraper in top of the eloquent  respose,it will transform each field in anything you want,
        // Eg the data in any format we want, date formated, paragraphs
        return PostResource::collection(Post::all());
    }
}
