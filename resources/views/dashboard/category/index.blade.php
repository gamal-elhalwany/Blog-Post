@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - MANAGE CATEGORIES')
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
            <h1>Manage Categories.</h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Parent</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <th>{{$category->name}}</th>
                        <th>{{$category->discription}}</th>
                        <th scope="row">
                            <a href="{{route('category.show', $category->slug)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>

                            <form action="{{ route('category.show', $category->slug) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>

                            <form method='POST' action="{{ route('category.destroy', $category->id) }}" style='display:inline'>
                                @csrf
                                @method('PATCH')
                                <button type="submit" class='btn btn-danger'>
                                    <i class="fas fa-trash-alt"></i>
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