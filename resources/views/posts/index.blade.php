<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
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

    <section class="search-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 mt-4 mb-4">
                    <div class="search-form">
                        <form action="" method="GET">
                            <div class="form-group">
                                <label for="user_name">Search by user name:</label>
                                <input class="form-control rounded-lg border-0 shadow-md" type="text" id="user_name" name="user_name" placeholder="Enter user name">
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control rounded-lg border-0 shadow-md">
                            </div>

                            <div class="form-group">
                                <label for="end_date">End date:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control rounded-lg border-0 shadow-md">
                            </div>

                            <button type="submit" class="btn btn-outline-primary mt-3">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="posts">
        <div class="container mx-auto">
            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-md-4 mt-3 mb-5">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2"><b>Title:</b> {{ $post->title }}</div>
                            </div>

                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">
                                    <img src="{{ asset('images/' . $post->image) }}" height="100px" width="100%">
                                </div>
                            </div>

                            <div class="px-6 py-4">
                                <p class="text-gray-700 dark:text-gray-400 text-base">
                                    <b>Description:</b> {{ $post->description }}
                                </p>
                                @if (auth()->id() == $post->user_id)
                                    <div class="m-3">
                                        <span class="p-3"><a
                                                href="{{ route('post.edit', $post->id) }}">Edit</a></span>
                                        <span class="p-3">
                                            <form action="{{ route('post.destroy', $post->id) }}" method="POST"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </span>
                                        <span class="p-3">{{ $post->status }}d</span>
                                    </div>
                                @endif
                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    <b>Auther:</b> {{ $post->user->name }}
                                </span>
                            </div>

                            <div class="px-6 pt-4 pb-2">
                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>


                        </div>
                    </div>
                    @empty
                    <div class="alert alert-danger text-center col-md-8 offset-md-2">Sorry, No Posts Found!</div>
                @endforelse
    </section>
</x-app-layout>
