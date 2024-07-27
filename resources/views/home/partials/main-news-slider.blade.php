<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            @if($mainSliderPosts->count())
            <div class="col-lg-8">
                <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                    @foreach($mainSliderPosts as $post)
                    <div class="position-relative overflow-hidden" style="height: 435px;">
                        <img class="img-fluid h-100" src="{{$post->default_image}}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-1">
                                <a class="text-white" href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                                <span class="px-2 text-white">/</span>
                                <a class="text-white" href="java::void()">{{$post->created_at->diffforHumans()}}</a>
                            </div>
                            <a class="h2 m-0 text-white font-weight-bold" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-lg-8">
                <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                    <div class="position-relative overflow-hidden" style="height: 435px;">
                        <img class="img-fluid h-100" src="{{asset('build/assets/img/news-700x435-1.jpg')}}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-1">
                                <a class="text-white" href="">Technology</a>
                                <span class="px-2 text-white">/</span>
                                <a class="text-white" href="">January 01, 2045</a>
                            </div>
                            <a class="h2 m-0 text-white font-weight-bold" href="">Sanctus amet sed amet ipsum lorem. Dolores et erat et elitr sea sed</a>
                        </div>
                    </div>
                    <div class="position-relative overflow-hidden" style="height: 435px;">
                        <img class="img-fluid h-100" src="{{asset('build/assets/img/news-700x435-2.jpg')}}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-1">
                                <a class="text-white" href="">Technology</a>
                                <span class="px-2 text-white">/</span>
                                <a class="text-white" href="">January 01, 2045</a>
                            </div>
                            <a class="h2 m-0 text-white font-weight-bold" href="">Sanctus amet sed amet ipsum lorem. Dolores et erat et elitr sea sed</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Categories</h3>
                    <button class="btn text-secondary font-weight-medium text-decoration-none cate-all">View All</button>
                </div>
                @foreach($categories->take(4) as $category)
                <div class="position-relative overflow-hidden mb-3" style="height:80px;">
                    <img class="img-fluid w-100 h-100" src="{{$category->default_image}}" style="object-fit: cover;">
                    <a href="{{route('category.show', $category->slug)}}" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                        {{$category->name}}
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->