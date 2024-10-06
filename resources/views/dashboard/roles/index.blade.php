@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - ROLES MANAGMENT')
@section('content')

<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Role Management</h2>
                    </div>
                    <div class="pull-right mb-3">
                        @can('create-role')
                        <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role </a>
                        @endcan
                    </div>
                </div>
            </div>


            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif


            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can('edit-role')
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endcan
                        @can('delete-role')
                        <form method='POST'action="{{route('roles.destroy', $role->id')" style="display:inline">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>

            {!! $roles->render() !!}

        </div>
    </div>
</div>
@endsection