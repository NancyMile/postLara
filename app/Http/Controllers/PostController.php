<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use Illuminate\Auth\Events\Validated;

class PostController extends Controller
{
    public function index(){
        $this->authorize('viewAny', Post::class);

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
        $this->authorize('create', Post::class);
        return inertia('Posts/Create');
    }

    public function store(StorePostRequest $request){
        $this->authorize('create', Post::class);
        Post::create($request->validated());

        return redirect()->route('posts.index')
            ->with('message','Post created sucessfully');
    }

    public function destroy(Post $post){
        $this->authorize('create', Post::class);
        $post->delete();
         return redirect()->route('posts.index')
            ->with('message', 'Post deleted succesfully.');
    }

    public function edit(Post $post){
        $this->authorize('create', Post::class);
        return inertia('Posts/Edit',compact('post'));
    }

    public function update(Post $post, StorePostRequest $request){
        $this->authorize('create', Post::class);
        $post->update($request->validated());
        return redirect()->route('posts.index')
            ->with('message', 'Post updated ');

    }

    public function show(){

    }
}
