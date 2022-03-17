@extends('layouts.admin')
@section('content')

    <h2 class="section-title">All Categories</h2>
    <div class="table-label-container">
        <h3 class="col-label label">Name</h3>
        <h3 class="col-label label">Actions</h3>
    </div>

    <ul class="posts-list">
        @foreach ($categories as $category)
            
        <li class="posts-item">
            <div class="post-info-container">
                <div class="post-element-container">
                    <span class="post-element">{{$category->name}}</span>
                </div>
                
                <div class="post-element-container">
                    <a class="btn-action" href="{{route('admin.categories.show', $category)}}">View <i class="fa-solid fa-caret-right"></i></a>
                    
                    @if(Auth::user()->roles()->get()->contains(1))
                        <form action="{{route("admin.categories.destroy", $category)}}" method="POST">
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