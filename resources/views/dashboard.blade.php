<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <ul style="display:inline">
                        <li class="nav-item" style="display: inline-block">
                            <a href="{{ route('post.index') }}" class="nav-link">Home</a>
                        </li>
                        @if (auth()->user()->posts()->where('status', 'inactivate')->count())
                        <li class="nav-item" style="display: inline-block">
                            <a href="{{ route('post.inactivated') }}" class="nav-link">Inactivated posts</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

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

    <section class="user-dshboard">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-dashboard-content">

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>