<!doctype html>
<html class="admin-document" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- <script src="{{ asset('js/front.js') }}" defer></script> --}}
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body @auth class="bg-secondary" @endauth>
    
    <main class="total-page-container">
        @php
            use App\User;
            use App\Model\Post;
            use App\Model\Role;
            use App\Model\Tag;
            use App\Model\Category;

            $users = User::all();
            $posts = Post::all();
            $categories = Category::all();
            $tags = Tag:: all();
            $admins = Role::where("roleName", "Admin")->get();
            // $topUsers = Post::withCount("user_id")->get();


            // SELECT `user_id`, COUNT(`user_id`) FROM `posts` GROUP BY `user_id`;
            $topUsers = DB::table("posts")->select("user_id", DB::raw("COUNT('user_id') as numPosts"))->groupBy("user_id")->orderBy(DB::raw("COUNT('user_id')"), "desc")->limit(5)->get();

            foreach ($topUsers as $topUser) {
                foreach ($users as $user) {
                    if($topUser->user_id == $user->id) {
                        $topUser->user_name = $user->name;
                    }
                }
            }

        @endphp
        {{-- @yield('content')   --}}
        
        <div class="dashboard">
            <div class="dashboard__left">
                <div class="left-side-container">
                    <div class="left-side__header">
                        <i class="fa-solid fa-bars btn-menu"></i>
                        @if(Auth::user()->roles()->get()->contains(1))
                            <span class="admin-badge">admin</span>
                        @endif
                    </div>

                    <div class="user-info-container">
                        <div class="img-container">
                            <img class="user-photo" src="{{asset('images/user-photo.jpeg')}}" alt="">
                            <span class="online-dot"></span>
                            <span class="user-name">{{Auth::user()->name}}</span>
                        </div>
                        
                        <div class="user-info">
                            <div class="email-container">
                                <span class="label info-lbl">Email</span>          
                                <span class="content">{{Auth::user()->email}}</span>
                            </div>

                            <div class="phone-container">
                                <span class="label info-lbl">Phone</span>          
                                <span class="content">{{Auth::user()->userInfo()->first()->phone}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="route-container">
                        <span class="list label">Posts</span>
                        <ul class="route-list">

                            <li class="route-item {{Route::currentRouteName() == 'admin.posts.index' || Route::currentRouteName() == 'admin.home' ? "active" : ""}}"> <a href="{{route('admin.posts.index')}}"><i class="fa-solid fa-earth-americas"></i> All Posts</a> </li>

                            <li class="route-item {{Route::currentRouteName() == 'admin.posts.myPosts' ? "active" : ""}}"> <a href="{{route('admin.posts.myPosts')}}"><i class="fa-solid fa-image-portrait"></i> My Posts</a> </li>

                            <li class="route-item {{Route::currentRouteName() == 'admin.posts.create' ? "active" : ""}}"> <a href="{{route('admin.posts.create')}}"><i class="fa-solid fa-plus"></i> Add Posts</a> </li>

                        </ul>
                        <span class="list label">Category</span>
                        <ul class="route-list">

                            <li class="route-item {{Route::currentRouteName() == 'admin.categories.index' ? "active" : ""}}"> <a href="{{route('admin.categories.index')}}"><i class="fa-solid fa-folder-open"></i> All Categories</a> </li>

                            <li class="route-item {{Route::currentRouteName() == 'admin.categories.create' ? "active" : ""}}"> <a href="{{route('admin.categories.create')}}"><i class="fa-solid fa-plus"></i> Add Category</a> </li>

                        </ul>


                        <div class="logout-container">
                            <a class="logout" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>



                    </div>
                </div>

            </div>
            {{-- RIGHT SIDE DASHBOARD --}}
            <div class="dashboard__right">
                <div class="top-overall-cards-container">
                    <h2 class="section-title">Summary</h2>
                    <div class="cards-container">

                        <div class="user card">
                            <div class="card-info">
                                <span class="number label">{{$users->count()}}</span>
                                <span class="label">Users</span>
                            </div>
                            <div class="icon-container">
                                <i class="fa-solid fa-user-group icon"></i>
                            </div>
                        </div>
                        <div class="admin card">
                            <div class="card-info">
                                <span class="number label">{{$admins->count()}}</span>
                                <span class="label">Admins</span>
                            </div>
                            <div class="icon-container">
                                <i class="fa-solid fa-user-lock icon"></i>
                            </div>
                        </div>
                        <div class="post card">
                            <div class="card-info">
                                <span class="number label">{{$posts->count()}}</span>
                                <span class="label">Posts</span>
                            </div>
                            <div class="icon-container">
                                <i class="fa-solid fa-address-card icon"></i>
                            </div>
                        </div>
                        <div class="category card">
                            <div class="card-info">
                                <span class="number label">{{$categories->count()}}</span>
                                <span class="label">Categories</span>
                            </div>
                            <div class="icon-container">
                                <i class="fa-solid fa-folder-minus icon"></i>
                            </div>
                        </div>
                        <div class="tag card">
                            <div class="card-info">
                                <span class="number label">{{$tags->count()}}</span>
                                <span class="label">Tags</span>
                            </div>
                            <div class="icon-container">
                                <i class="fa-solid fa-hashtag icon"></i>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="bottom-right-container">
                    <div class="page-content-container">
                        <div class="section-container">
                            @yield("content")
                        </div>
                    </div>
                    <div class="most-active-users-container">
                        <h2 class="section-title">Most Active Users</h2>
                        <div class="users-list-container">
                            <ul class="users-list">
                                @foreach ($topUsers as $topUser)  
                                    <a href="{{route('admin.posts.topUserPosts', $topUser->user_id)}}">
                                        <li class="users-item">
                                            <div class="user">
                                                <img src="{{asset('images/user-photo.jpeg')}}" alt="">
                                                <div class="topUser-info">
                                                    <span class="user-name">{{$topUser->user_name}}</span>
                                                    <span class="label">Posts: {{$topUser->numPosts}}</span>
                                                    
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
        
    {{-- </div> --}}
</body>
</html>
