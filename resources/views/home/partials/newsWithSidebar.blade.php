<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Popular</h3>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="{{route('posts.popular')}}">View All</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @foreach($popularPostsSection1 as $post)
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{$post->default_image}}" style="object-fit: cover;height:210px;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="{{route('category.show', $post->category->id)}}">{{$post->category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$post->created_at->diffforHumans()}}</span>
                                </div>
                                <a class="h4" href="{{route('post.show', $post->id)}}">{{Str::limit($post->title, 25)}}</a>
                                <p class="m-0">{{Str::limit($post->description, 70)}}</p>
                            </div>
                        </div>
                        @endforeach
                        @foreach($popularPostsSection1LastTwo as $lastTwoPosts)
                        <div class="d-flex mb-3">
                            <img src="{{$lastTwoPosts->default_image}}" style="width: 100px; height: 100px; object-fit: cover;width:100px;height:100px;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="{{route('category.show', $lastTwoPosts->category->slug)}}">{{$lastTwoPosts->category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$lastTwoPosts->created_at->diffforHumans()}}</span>
                                </div>
                                <a class="h6 m-0" href="{{route('post.show', $lastTwoPosts->id)}}">{{Str::limit($lastTwoPosts->title, 70)}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        @foreach($popularPostsSection2 as $post)
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{$post->default_image}}" style="object-fit: cover;height:210px;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="{{route('category.show', $post->category->id)}}">{{$post->category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$post->created_at->diffforHumans()}}</span>
                                </div>
                                <a class="h4" href="{{route('post.show', $post->id)}}">{{Str::limit($post->title, 25)}}</a>
                                <p class="m-0">{{Str::limit($post->description, 70)}}</p>
                            </div>
                        </div>
                        @endforeach
                        @foreach($popularPostsSection2LastTwo as $lastTwoPosts)
                        <div class="d-flex mb-3">
                            <img src="{{$lastTwoPosts->default_image}}" style="width: 100px; height: 100px; object-fit: cover;width:100px;height:100px;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="{{route('category.show', $lastTwoPosts->category->slug)}}">{{$lastTwoPosts->category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$lastTwoPosts->created_at->diffforHumans()}}</span>
                                </div>
                                <a class="h6 m-0" href="{{route('post.show', $lastTwoPosts->id)}}">{{Str::limit($lastTwoPosts->title, 70)}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3 pb-3">
                    <a href=""><img class="img-fluid w-100" src="{{asset('build/assets/img/ads-700x70.jpg')}}" alt=""></a>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Latest</h3>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="{{route('posts.latest')}}">View All</a>
                        </div>
                    </div>
                    @foreach($latestPostsSection1 as $post)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{$post->default_image}}" style="object-fit: cover;  height: 210px;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$post->created_at->diffforHumans()}}</span>
                                </div>
                                <a class="h4" href="{{route('post.show', $post->id)}}">{{Str::limit($post->title, 22)}}</a>
                                <p class="m-0">{{Str::limit($post->description, 70)}}</p>
                            </div>
                        </div>
                        @foreach($latestPostsSection1LastTwo as $post)
                        <div class="d-flex mb-3">
                            <img src="{{$post->default_image}}" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$post->created_at->diffforHumans()}}</span>
                                </div>
                                <a class="h6 m-0" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach

                    @foreach($latestPostsSection2 as $post)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{$post->default_image}}" style="object-fit: cover; height: 210px;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$post->created_at->diffforHumans()}}</span>
                                </div>
                                <a class="h4" href="{{route('post.show', $post->id)}}">{{Str::limit($post->title, 22)}}</a>
                                <p class="m-0">{{Str::limit($post->description, 70)}}</p>
                            </div>
                        </div>
                        @foreach($latestPostsSection2LastTwo as $post)
                        <div class="d-flex mb-3">
                            <img src="{{$post->default_image}}" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$post->created_at->diffforHumans()}}</span>
                                </div>
                                <a class="h6 m-0" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>

            <x-sidebar />
        </div>
    </div>
</div>
<!-- News With Sidebar End -->