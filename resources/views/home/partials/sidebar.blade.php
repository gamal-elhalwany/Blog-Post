<div class="col-lg-4 pt-3 pt-lg-0">
    <!-- Social Follow Start -->
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Follow Us</h3>
        </div>
        <div class="d-flex mb-3">
            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #39569E;">
                <small class="fab fa-facebook-f mr-2"></small><small>12,345 Fans</small>
            </a>
            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #52AAF4;">
                <small class="fab fa-twitter mr-2"></small><small>12,345 Followers</small>
            </a>
        </div>
        <div class="d-flex mb-3">
            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #0185AE;">
                <small class="fab fa-linkedin-in mr-2"></small><small>12,345 Connects</small>
            </a>
            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #C8359D;">
                <small class="fab fa-instagram mr-2"></small><small>12,345 Followers</small>
            </a>
        </div>
        <div class="d-flex mb-3">
            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #DC472E;">
                <small class="fab fa-youtube mr-2"></small><small>12,345 Subscribers</small>
            </a>
            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #1AB7EA;">
                <small class="fab fa-vimeo-v mr-2"></small><small>12,345 Followers</small>
            </a>
        </div>
    </div>
    <!-- Social Follow End -->

    <!-- Newsletter Start -->
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Newsletter</h3>
        </div>
        <div class="bg-light text-center p-4 mb-3">
            <p>Subscribe to our newsletter.</p>
            <form id="newsletterForm" action="{{route('newsletters.subscribe')}}" method="POST">
                @csrf
                <div class="input-group" style="width: 100%;">
                    <input type="text" class="form-control form-control-lg" name="email" placeholder="Your Email" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                </div>
                @error('email')
                <b class="text-danger mt-2">{{$message}}</b>
                @enderror
            </form>
        </div>
    </div>
    <!-- Newsletter End -->

    <!-- Ads Start -->
    <div class="mb-3 pb-3">
        <a href=""><img class="img-fluid" src="{{asset('build/assets/img/news-500x280-4.jpg')}}" alt=""></a>
    </div>
    <!-- Ads End -->

    <!-- Trending News Start -->
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Trending</h3>
        </div>
        <div class="d-flex mb-3">
            <img src="{{asset('build/assets/img/news-100x100-1.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                <div class="mb-1" style="font-size: 13px;">
                    <a href="">Technology</a>
                    <span class="px-1">/</span>
                    <span>January 01, 2045</span>
                </div>
                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
            </div>
        </div>
        <div class="d-flex mb-3">
            <img src="{{asset('build/assets/img/news-100x100-2.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                <div class="mb-1" style="font-size: 13px;">
                    <a href="">Technology</a>
                    <span class="px-1">/</span>
                    <span>January 01, 2045</span>
                </div>
                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
            </div>
        </div>
        <div class="d-flex mb-3">
            <img src="{{asset('build/assets/img/news-100x100-3.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                <div class="mb-1" style="font-size: 13px;">
                    <a href="">Technology</a>
                    <span class="px-1">/</span>
                    <span>January 01, 2045</span>
                </div>
                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
            </div>
        </div>
        <div class="d-flex mb-3">
            <img src="{{asset('build/assets/img/news-100x100-4.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                <div class="mb-1" style="font-size: 13px;">
                    <a href="">Technology</a>
                    <span class="px-1">/</span>
                    <span>January 01, 2045</span>
                </div>
                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
            </div>
        </div>
        <div class="d-flex mb-3">
            <img src="{{asset('build/assets/img/news-100x100-5.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                <div class="mb-1" style="font-size: 13px;">
                    <a href="">Technology</a>
                    <span class="px-1">/</span>
                    <span>January 01, 2045</span>
                </div>
                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
            </div>
        </div>
    </div>
    <!-- Trending News End -->

    <!-- Tags Start -->
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Tags</h3>
        </div>
        <div class="d-flex flex-wrap m-n1">
            @forelse($tags as $tag)
            <a href="{{route('category.show', $category->slug)}}" class="btn btn-sm btn-outline-secondary m-1">{{ucwords($tag->name)}}</a>
            @empty
            <p class="ml-3">No Tags found!</p>
            @endforelse
        </div>
    </div>
    <!-- Tags End -->
</div>