<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-8 00 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <section class="edit-post-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card mt-5 mb-5">
                        <div class="card-header">
                            <h3 class="card-title">Edit Post</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('post.update', $post->id) }}"        method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group p-2">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
                                    @error('title')
                                        <p class="text-red-500 mt-3 mb-3">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group p-2">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" id="description" class="form-control" value="{{ $post->description }}">
                                    @error('description')
                                        <p class="text-red-500 mt-3 mb-3">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group p-2">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control p-3">
                                    @error('image')
                                        <p class="text-red-500 mt-3 mb-3">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="p-3">
                                    <select class="form-control" name="status">
                                        <option value="">Status</option>
                                        <option value="Activate">activate</option>
                                        <option value="Inactivate">inactivate</option>
                                    </select>
                                </div>
                                <div class="form-group p-2">
                                    <button class="btn btn-outline-primary mt-3" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
