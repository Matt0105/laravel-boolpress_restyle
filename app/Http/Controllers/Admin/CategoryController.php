<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categories.create");
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
            "name" => "required|max:255",
        ]);

        $newCategory = new Category();

        $data = $request->all();
        $slug = Str::slug($data["name"], '-');
        $ifSlugThereIs = Category::where("slug", $slug)->first();

        $slugCounter = 0;
        while($ifSlugThereIs) {
            $slug = $slug . '-' . $slugCounter;
            $ifSlugThereIs = Category::where("slug", $slug)->first();
            $slugCounter++;
        }

        $newCategory->name = $data["name"];
        $newCategory->slug = $slug;

        $newCategory->save();

        return redirect()->route("admin.categories.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("admin.categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $posts = Post::where("category_id", $category->id)->get();

        foreach ($posts as $post) {
            $post->category_id = 1; //category generic
            $post->save();
        }

        if($category->name != "Generic") {
            $category->delete();
            return redirect()->route("admin.categories.index")->with("status", "Category '$category->name' deleted");
        }
        else {
            return redirect()->route("admin.categories.index")->with("warning", "You can't delete 'Generic' Category!");
        }

    }
}
