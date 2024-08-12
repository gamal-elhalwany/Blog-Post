@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - CREATE CATEGORY')
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
            <h1 class="fw-bold fs-3 mb-4">Create Category</h1>
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                    <p class="text-red-500 mt-3 mb-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Parent Category</label>
                    <select class="form-control" name="parent_id">
                        <option value="">Select Parent Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
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
                    <label for="">Tags</label>
                    <input name="tags" class="form-control" placeholder="Add the category tags...">
                    @error('tags')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary btn-lg mt-4 mb-6">SUBMIT CATEGORY</button>
                </div>
            </form>
        </div>
        <x-sidebar />
    </div>
</div>
<script>

</script>
@endsection