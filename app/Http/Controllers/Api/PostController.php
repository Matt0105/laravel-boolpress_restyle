<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\Category;
use App\Model\Tag;
use App\User;

use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function index() 
    {
        $posts = Post::inRandomOrder()->limit(4)->get();
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::with("posts")->get();

        return response()->json([
            "response" => true,
            "resultsPosts" => [
                "data" => $posts
            ],
            "resultsUsers" => $users,
            "resultsCategories" => $categories,
            "resultsTags" => $tags
        ]);
    }

    public function allPosts() {
        $posts = Post::paginate(5);
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::with("posts")->get();

        return response()->json([
            "response" => true,
            "resultsPosts" => $posts,
            "resultsUsers" => $users,
            "resultsCategories" => $categories,
            "resultsTags" => $tags
        ]);
    }

    public function show($id) {
        $post = Post::find($id);
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::with("posts")->get();

        return response()->json([
            "response" => true,
            "resultsPosts" => [
                "data" => $post
            ],
            "resultsUsers" => $users,
            "resultsCategories" => $categories,
            "resultsTags" => $tags
        ]);
    }

    public function filter(Request $request) {
        $data = $request->all();

        $posts = Post::where("id", ">=", 1);
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::with("posts")->get();

        if(array_key_exists("orderCol", $data) && array_key_exists("orderVs", $data)) {
            $posts->orderBy($data["orderCol"], $data["orderVs"]);
        }

        if(array_key_exists("tags", $data)) {
            foreach ($data["tags"] as $tag) {
                $posts->whereHas("tags", function (Builder $query) use ($tag) {
                    $query->where("name", "=", $tag);
                });
            }
        }

        return response()->json([
            "response" => true,
            "resultsPosts" => [
                "data" => $posts->get()
            ],
            "resultsUsers" => $users,
            "resultsCategories" => $categories,
            "resultsTags" => $tags
        ]);
    }
}
