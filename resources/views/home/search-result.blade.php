@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - SEARCH RESULT')
@section('content')
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Search Result</h3>
                </div>
                <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative">
                    @forelse($results as $result)
                    <div class="position-relative overflow-hidden" style="height: 450px;">
                        <img class="img-fluid w-100 h-100" src="{{$result->default_image}}" style="object-fit: cover; height: 100px; width: 100px;">
                        <div class="overlay">
                            <div class="mb-1" style="font-size: 13px;">
                                <a class="text-white" href="">{{$result->category->name}}</a>
                                <span class="px-1 text-white">/</span>
                                <a class="text-white" href="java::void()">{{$result->created_at->diffforHumans()}}</a>
                            </div>
                            <a class="h4 m-0 text-white" href="{{route('post.show', $result->id)}}">{{$result->title}}</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <h3>No result found</h3>
                    </div>
                    @endforelse
                </div>
            </div>
            <x-sidebar />
        </div>
    </div>
</div>
@endsection