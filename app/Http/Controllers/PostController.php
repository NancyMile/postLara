<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(){

        $orderColumn = request('order_column','created_at');
        if(!in_array($orderColumn,['id','title','created_at'])){
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if(!in_array($orderDirection,['asc','desc'])){
            $orderDirection = 'desc';
        }

        $posts = Post::with('category')
            ->when(request('category'), function($query){
                $query->where('category_id',request('category'));
            } )
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(10);

        // this resource is a wraper in top of the eloquent  respose,it will transform each field in anything you want,
        // Eg the data in any format we want, date formated, paragraphs
        //return PostResource::collection($posts);


        $posts = PostResource::collection($posts);

        return inertia('Posts/Index', compact('posts'));
    }

    public function create(){
        return inertia('Posts/Create');
    }

    public function store(Request $request){
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('posts.index');
    }

    public function show(){

    }
}
