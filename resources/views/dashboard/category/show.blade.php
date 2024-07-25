@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - SINGLE CATEGORY')
@section('content')

@section('breadcrumb')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="#">Home</a>
            <a class="breadcrumb-item" href="#">Category</a>
            <span class="breadcrumb-item active">{{$category->name}}</span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->
@endsection

<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">{{$category->name}}</h3>
                        </div>
                    </div>
                    @foreach ($section1 as $post)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{$category->default_image}}" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="{{ route('category.show', $category->slug) }}">{{$category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$post->created_at->diffforHumans()}}</span>
                                </div>
                                <div style="height:150px; overflow:hidden;">
                                    <a class="h4" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                                    <p class="m-0">{{Str::limit($post->description, 150)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <a href=""><img class="img-fluid w-100" src="{{asset('build/assets/img/ads-700x70.jpg')}}" alt=""></a>
                </div>

                <div class="row">
                    @foreach ($section2 as $post)
                    <div class="col-lg-6">
                        <div class="d-flex mb-3">
                            <img src="{{$category->default_image}}" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="{{route('post.show', $post->id)}}">{{$post->category->name}}</a>
                                    <span class="px-1">/</span>
                                    <span>{{$post->created_at->diffforHumans()}}</span>
                                </div>
                                <a class="h6 m-0" href="">{{$post->title}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Pagenation Links Start -->
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                {{$posts->withQueryString()->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Pagenation Links End -->
            </div>
            @include('home.partials.sidebar')
        </div>
    </div>
</div>
<!-- News With Sidebar End -->

@endsection