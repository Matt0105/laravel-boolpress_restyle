@extends('layouts.admin')

@section('content')

    <h2 class="section-title">All Posts for '<span class="highlight">{{$category->name}}</span>' Category</h2>
    <div class="table-label-container">
        <h3 class="col-label label">User</h3>
        <h3 class="col-label label">Title</h3>
        <h3 class="col-label label category">Category</h3>
        <h3 class="col-label label">Actions</h3>
    </div>

    <ul class="posts-list">
        @foreach ($category->posts()->get() as $post)
            
        <li class="posts-item">
            <div class="post-info-container">
                <div class="post-element-container">
                    <span class="post-element">{{$post->user()->first()->name}}</span>
                </div>
                <div class="post-element-container">
                    <span class="post-element">{{$post->title}}</span>   
                </div>
                <div class="post-element-container category">
                    <span class="post-element">{{$category->name}}</span>
                </div>
                <div class="post-element-container">
                    <a class="btn-action" href="{{route('admin.posts.show', $post)}}">View <i class="fa-solid fa-caret-right"></i></a>
                    @if ($post->user_id == Auth::user()->id || Auth::user()->roles()->get()->contains(1))
                        <a class="btn-action edit" href="{{route('admin.posts.edit', $post)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{route("admin.posts.destroy", $post)}}" method="POST">
                            @csrf
                            @method("DELETE")

                            {{-- <input class="btn-action" type="submit" value="Delete"> --}}
                            <button class="btn-action delete" type="submit"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    @endif
                    
                </div>
            </div>
        </li>
        @endforeach
        
    </ul>

@endsection