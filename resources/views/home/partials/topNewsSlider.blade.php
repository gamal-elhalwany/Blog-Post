<!-- Top News Slider Start -->
@if(session()->has('error'))
<div class="container-fluid py-3">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('error')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session()->get('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if($topSliderPosts->count())
<div class="container-fluid py-3">
    <div class="container">
        <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">
            @forelse($topSliderPosts as $post)
            <div class="d-flex" style="width:100%;">
                <img src="{{$post->default_image}}" style="width: 80px; height: 80px; object-fit: cover;">
                <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                    <a class="text-secondary font-weight-semi-bold p-4" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                </div>
            </div>
            @empty
            <div class="d-flex">
                <div class="alert alert-danger">
                    <b>No posts found!</b>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endif
<!-- Top News Slider End -->