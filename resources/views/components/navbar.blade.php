<!-- Navbar Start -->
<div class="container-fluid p-0 mb-3">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
        <a href="" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">News</span>Room</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        @foreach($categories as $category)
                        <a href="{{route('category.show', $category->slug)}}" class="dropdown-item">
                            {{$category->name}}
                            @if($category->children->count())
                            <span class="badge badge-primary ml-1">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                            @endif
                        </a>
                        @if ($category->children->isNotEmpty())
                        @foreach($category->children as $child)
                        <ul>
                            <li class="dropdown-item">
                                <a href="{{route('category.show', $child->slug)}}" class="dropdown-item">{{$child->name}}</a>
                            </li>
                        </ul>
                        @endforeach
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Options</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{route('category.create')}}" class="dropdown-item">Create Category</a>
                        <a href="{{route('post.create')}}" class="dropdown-item">Create Post</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <form action="" method="GET">
                <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Keyword">
                    <div class="input-group-append">
                        <button class="input-group-text text-secondary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </nav>
</div>
<!-- Navbar End -->