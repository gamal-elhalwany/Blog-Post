@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - HOME')
@section('content')
    @include('home.partials.topNewsSlider')
    @include('home.partials.main-news-slider')
    @include('home.partials.featuredNewsSlider')
    @include('home.partials.categoryNewsSlider')
    @include('home.partials.newsWithSidebar')
@endsection