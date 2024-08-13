@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - FEATURED POSTS')
@section('content')

@if($posts->count())
<div class="container-fluid py-3">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Featured Posts</h3>
        </div>
        <div class="owl-carousel owl-carousel-2 carousel-item-{{$posts->count()}} position-relative">
            @foreach($posts as $post)
            <div class="position-relative overflow-hidden" style="height: 300px;">
                <img class="img-fluid w-100 h-100" src="{{$post->default_image}}" style="object-fit: cover;">
                <div class="overlay">
                    <div class="mb-1" style="font-size: 13px;">
                        <a class="text-white" href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                        <span class="px-1 text-white">/</span>
                        <a class="text-white" href="java::void()">{{$post->created_at->diffforHumans()}}</a>
                    </div>
                    <a class="h4 m-0 text-white" href="{{route('post.show', $post->id)}}">{{$post->title}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection