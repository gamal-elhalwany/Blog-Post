<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row align-items-center bg-light px-lg-5">
        <div class="col-12 col-md-8">
            <div class="d-flex justify-content-between">
                <div class="bg-primary text-white text-center py-2" style="width: 100px;">Trending</div>
                <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">
                    @foreach($trendingPosts as $post)
                    <div class="text-truncate"><a class="text-secondary" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 text-right d-none d-md-block">
            @auth
            <span class="mr-4 dropdown">Hello
                <a href="java::viod()" class="text-danger dropdown-toggle text-decoration-none" data-toggle="dropdown">
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </ul>
            </span>
            @else
            <span class="mr-4 dropdown">
                <a href="{{route('register')}}" class="col">Register</a>
                <a href="{{route('login')}}" class="col">Sign up</a>
            </span>
            @endauth
            {{$now}}
        </div>
    </div>
    <div class="row align-items-center py-2 px-lg-5">
        <div class="col-lg-4">
            <a href="{{route('home')}}" class="navbar-brand d-none d-lg-block">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">News</span>Room</h1>
            </a>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
            <img class="img-fluid" src="{{asset('build/assets/img/ads-700x70.jpg')}}" alt="">
        </div>
    </div>
</div>
<!-- Topbar End -->