@extends('layouts.admin')

@section('content')

<div class="view-container">
    <div class="post-container">
        <a href="{{route('admin.categories.show', $post->category)}}"><span class="category-badge">{{$post->category->name}}</span></a>
        <div class="userName-container">
            <img src="{{asset('images/user-photo.jpeg')}}" alt="">
            <span>{{$post->user()->first()->name}}</span>
        </div>
        <div class="title-container">
            <h3 class="post-title">{{$post->title}}</h3>
        </div>
        <div class="content-container">
            <p class="post-content">
                {{$post->content}}
            </p>
        </div>
        @if(!empty($post->image))
            <div class="image-container">
                <img src="{{asset("storage/" . $post->image)}}" alt="{{$post->title}}">
            </div>
        @endif
        <div class="tags-container">
            {{-- @if(!empty($post->tags()->get())) --}}
            <ul class="tags-list">
                @foreach ($post->tags()->get() as $tag) 
                    <li class="tag-item">{{$tag->name}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection