@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - ROLES MANAGMENT - SHOW ROLE')
@section('content')

<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2> Show Role</h2>
                    </div>
                    <div class="pull-right mb-3">
                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $role->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permissions:</strong>
                        @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                        <label class="label label-success">{{ $v->name }},</label>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection