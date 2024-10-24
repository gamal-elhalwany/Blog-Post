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
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <h1>Your Notification</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Header: </strong>{{$notification->data['header']}}</h5>
                    <p class="card-text"><strong>Message: </strong>{{$notification->data['body']}}</p>
                    <p><strong>Created_at: </strong>{{$notification->created_at->DiffForHumans()}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection