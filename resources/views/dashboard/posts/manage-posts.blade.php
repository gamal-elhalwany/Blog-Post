@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - CREATE POSTS')
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
            <h1>Manage Posts.</h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <th>{{$post->title}}</th>
                        <th>{{$post->status}}</th>
                        <th scope="row">
                            <a href="{{route('post.show', $post->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>

                            <form action="{{ route('posts.approve', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>

                            <form method='POST' action="{{ route('posts.reject', $post->id) }}" style='display:inline'>
                                @csrf
                                @method('PATCH')
                                <button type="submit" class='btn btn-danger'>
                                    <i class="far fa-times-circle"></i>
                                </button>
                            </form>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection