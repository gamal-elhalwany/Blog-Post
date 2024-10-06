@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - USERS MANAGMENT')
@section('content')

<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Users Management</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success mb-4 mt-3" href="{{ route('users.create') }}"> Create New User </a>
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
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form method='POST' action="{{ route('users.destroy', $user->id) }}" style='display:inline'>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class='btn btn-danger'>
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <x-sidebar />
    </div>
</div>

@endsection