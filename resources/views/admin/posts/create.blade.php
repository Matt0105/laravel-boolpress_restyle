@extends('layouts.admin')

@section('content')

    <h2 class="section-title">Create New Post</h2>
    <div class="create-form-container">
        <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("POST")

            <div class="row">
                <label for="title" class="label">Title</label>
                <input type="text" class="form-input title" id="title" name="title" value="{{old('title')}}">
                
                <select class="form-input category" name="category_id">
                    <option value="">Select a Category</option>
                    @foreach ($categories as $category)
                        <option {{old("category_id") == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>   
                    @endforeach
                    
                </select>
                @error('title')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
                @error('category_id')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="row">
                <div class="mb-3">
                    <label for="content" class="label">Content</label>
                    <textarea class="form-input textarea" id="content"  name="content">{{old('content')}}</textarea>
                    @error('content')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <label class="custom-btn">
                    <input type="file" class="" id="image" name="image" >
                    <span class="form-input file">Choose File</span>
                </label>
                
                @error('image')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
    
            <div class="row">
                <label for="tags" class="label">Tags</label>
                <div class="tags-container">
                    @foreach ($tags as $tag)
                    
                        <div class="single-tag">
                            <input {{in_array($tag->id, old("tags", [])) ? "checked" : ""}} class="" type="checkbox" value="{{$tag->id}}" name="tags[]">
                            <label class="tag-name" for="flexCheckDefault">
                            {{$tag->name}}
                            </label>
                        </div>
                    @endforeach
                    @error('tags.*')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <input class="btn btn-success send" type="submit">
            
        </form>
    </div>
@endsection