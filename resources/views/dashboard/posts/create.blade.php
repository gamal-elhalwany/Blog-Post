@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - CREATE CATEGORY')
@section('content')
<x-topbar />
@include('home.partials.navbar')
<div class="container-fluid">
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

            <h1 class="fw-bold fs-3 mb-4">Add Post</h1>
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                    @error('title')
                    <p class="text-red-500 mt-3 mb-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                    @error('description')
                    <p class="text-red-500 mt-3 mb-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                    <p class="text-red-500 mt-3 mb-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <p class="text-red-500 mt-3 mb-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary btn-lg mt-4 mb-6">ADD POST</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection