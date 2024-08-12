@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - EDIT POST')
@section('content')
<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <h1 class="fw-bold fs-3 mb-4">Edit Post</h1>
            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{$post->title}}">
                    @error('title')
                    <p class="text-danger mt-3 mb-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control">{{$post->description}}</textarea>
                    @error('description')
                    <p class="text-danger mt-3 mb-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{ $post->default_image }}" alt="image" width="150px" hight="150px;">
                    @error('image')
                    <p class="text-danger mt-3 mb-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-red-500 mt-3 mb-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary btn-lg mt-4 mb-6">UPDATE POST</button>
                </div>
            </form>

        </div>
        <x-sidebar />
    </div>
</div>
@endsection