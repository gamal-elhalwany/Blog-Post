<!-- Category News Slider Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Business</h3>
                </div>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    @foreach($categoryBusinessPosts as $post)
                    <div class="position-relative" style="height:300px;">
                        <img class="img-fluid w-100" src="{{$post->default_image}}" style="object-fit: cover; height: 50%;">
                        <div class="overlay position-relative bg-light" style="height: 50%; display:block">
                            <div class="mb-2" style="font-size: 13px;">
                                <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                                <span class="px-1">/</span>
                                <span>{{$post->created_at->diffforHumans()}}</span>
                            </div>
                            <a class="h4 m-0" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Technology</h3>
                </div>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    @foreach($categoryTechnologyPosts as $post)
                    <div class="position-relative" style="height:300px;">
                        <img class="img-fluid w-100" src="{{$post->default_image}}" style="object-fit: cover; height: 50%;">
                        <div class="overlay position-relative bg-light" style="height: 50%; display:block">
                            <div class="mb-2" style="font-size: 13px;">
                                <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                                <span class="px-1">/</span>
                                <span>{{$post->created_at->diffforHumans()}}</span>
                            </div>
                            <a class="h4 m-0" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <div class="row">
        <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Entertainment</h3>
                </div>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    @foreach($categoryEntertainmentPosts as $post)
                    <div class="position-relative" style="height:300px;">
                        <img class="img-fluid w-100" src="{{$post->default_image}}" style="object-fit: cover; height: 50%;">
                        <div class="overlay position-relative bg-light" style="height: 50%; display:block">
                            <div class="mb-2" style="font-size: 13px;">
                                <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                                <span class="px-1">/</span>
                                <span>{{$post->created_at->diffforHumans()}}</span>
                            </div>
                            <a class="h4 m-0" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Sports</h3>
                </div>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    @foreach($categorySportsPosts as $post)
                    <div class="position-relative" style="height:300px;">
                        <img class="img-fluid w-100" src="{{$post->default_image}}" style="object-fit: cover; height: 50%;">
                        <div class="overlay position-relative bg-light" style="height: 50%; display:block">
                            <div class="mb-2" style="font-size: 13px;">
                                <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                                <span class="px-1">/</span>
                                <span>{{$post->created_at->diffforHumans()}}</span>
                            </div>
                            <a class="h4 m-0" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category News Slider End -->