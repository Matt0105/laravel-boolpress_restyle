<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy("updated_at", "desc")->get();

        return view('admin.posts.index', compact("posts"));
    }

    public function topUserPosts($id)
    {
        $userPosts = Post::where("user_id", $id)->get();
        return view('admin.posts.topUserPosts', compact("userPosts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.create", ["categories" => $categories, "tags" => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            "title" => "required|max:255",
            "content" => "required",
            "category_id" => "exists:App\Model\Category,id",
            "tags.*" => "exists:App\Model\Tag,id",
            "image" => "nullable|image"
        ]);

        $newPost = new Post();

        $data = $request->all();
        
        $slug = Str::slug($data["title"], '-');
        $ifSlugThereIs = Post::where("slug", $slug)->first();

        $slugCounter = 0;
        while($ifSlugThereIs) {
            $slug = $slug . '-' . $slugCounter;
            $ifSlugThereIs = Post::where("slug", $slug)->first();
            $slugCounter++;
        }
        
        if(!empty($data["image"])) {
            $file_path = Storage::put("uploads", $data["image"]);
            $data["image"] = $file_path;
        }

        $newPost->title = $data["title"];
        $newPost->content = $data["content"];
        $newPost->category_id = $data["category_id"];
        $newPost->slug = $slug;
        $newPost->user_id = Auth::user()->id;
        if(!empty($data["image"])) {
            $newPost->image = $data["image"];
        }

        $newPost->save();

        if(!empty($data["tags"])) {

            $newPost->tags()->sync($data["tags"]);
        } else {
            $newPost->tags()->sync([]);
        }

        // $newPost->tags()->sync()

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.edit", ["post" => $post, "categories" => $categories, "tags" => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        if(Auth::user()->id != $post->user_id && !Auth::user()->roles()->get()->contains(1)) {
            abort("403");
        }

        $validation = $request->validate([
            "title" => "required|max:255",
            "content" => "required",
            "category_id" => "exists:App\Model\Category,id",
            "tags.*" => "exists:App\Model\Tag,id",
            "image" => "nullable|image"
        ]);

        $data = $request->all();
        $slug = Str::slug($data["title"], '-');
        $ifSlugThereIs = Post::where("slug", $slug)->first();

        $slugCounter = 0;
        while($ifSlugThereIs) {
            $slug = $slug . '-' . $slugCounter;
            $ifSlugThereIs = Post::where("slug", $slug)->first();
            $slugCounter++;
        }

        
        $post->title = $data["title"];
        $post->content = $data["content"];
        $post->category_id = $data["category_id"];
        $post->slug = $slug;
        if(!empty($data["image"])) {
            $file_path = Storage::put("uploads", $data["image"]);
            $data["image"] = $file_path;
            $post->image = $data["image"];
        }

        $post->save();

        if(!empty($data["tags"])) {
            $post->tags()->sync($data["tags"]);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route("admin.posts.index", compact("post"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Auth::user()->id != $post->user_id && !Auth::user()->roles()->get()->contains(1)) {
            abort("403");
        }
        $post->tags()->detach();
        $post->delete();

        //se provengo da my-post al momento della cancellazione rimango nella stessa pagina
        if(strpos(url()->previous(), "/admin/my-posts")) {
            return redirect()->route('admin.posts.myPosts')->with("status", "Post '$post->title' deleted");
        }
        return redirect()->route('admin.posts.index')->with("status", "Post '$post->title' deleted");
    }

    public function filter() {

        $posts = Post::orderBy("updated_at", "desc")->where("user_id", Auth::user()->id)->paginate(10);

        return view('admin.posts.myPosts', compact("posts"));
    }
}
