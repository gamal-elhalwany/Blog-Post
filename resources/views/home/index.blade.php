@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM')
@section('content')
    <x-topbar />
    @include('home.partials.navbar')
    @include('home.partials.topNewsSlider')
    @include('home.partials.main-news-slider')
    @include('home.partials.featuredNewsSlider')
    @include('home.partials.categoryNewsSlider')
    @include('home.partials.newsWithSidebar')
@endsection