@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - ROLES MANAGMENT - EDIT ROLE')
@section('content')

<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Role</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back </a>
                    </div>
                </div>
            </div>


            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> something went wrong.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method='POST' action="{{route('roles.update', $role->id)}}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" placeholder="Name" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br />
                            @foreach($permission as $value)
                            <label>
                                <input type="checkbox" name="permission[]" value="{{ $value->name }}"
                                    {{(in_array($value->id, $rolePermissions)) }} cheched class="name">
                                {{ $value->name }}
                            </label>
                            <br />
                            @endforeach
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection