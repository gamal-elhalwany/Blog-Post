<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inactive Posts') }}
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

    <section class="posts">
        <div class="container mx-auto">
            <div class="row">
                @foreach ($posts as $post)
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
                @endforeach
    </section>
</x-app-layout>
