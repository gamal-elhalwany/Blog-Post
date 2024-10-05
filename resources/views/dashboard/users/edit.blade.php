@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - EDIT USER')
@section('content')

<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit New User</h2>
                    </div>
                    <div class="pull-right mt-3 mb-3">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back </a>
                    </div>
                </div>
            </div>

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Something went wrong.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method='POST' action="{{route('users.update', $user->id)}}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name='name' placeholder='Name' class='form-control py-4' />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="text" name='email' placeholder='Email' class='form-control py-4' />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" name='password' placeholder='Password' class='form-control py-4' />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Confirm Password:</strong>
                            <input type="text" name='confirm-password' placeholder='Confirm Password' class='form-control py-4' />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role:</strong>
                            <select name="roles[]" class="form-control py-4" multiple>
                                @foreach($roles as $value => $role)
                                <option value="{{ $value }}" {{ in_array($value, $userRole) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <x-sidebar />
    </div>
</div>

@endsection