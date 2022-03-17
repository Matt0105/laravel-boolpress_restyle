@extends('layouts.admin')

@section('content')

    <h2 class="section-title">Create New Post</h2>
    <div class="create-form-container">
        <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("POST")

            <div class="row">
                <label for="name" class="label">Category Name</label>
                <input type="text" class="form-input title" id="name" name="name" value="{{old('name')}}">
                
                @error('title')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
               
            </div>

            <input class="btn btn-success send" type="submit">
        </form>
    </div>
@endsection