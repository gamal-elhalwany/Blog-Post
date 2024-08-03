@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - SINGLE POST')
@section('content')

<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">

        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session()->get('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <!-- News Detail Start -->
                <div class="position-relative mb-3">
                    <img class="img-fluid w-100" src="{{ $post->default_image }}" style="object-fit: cover;">
                    <div class="overlay position-relative bg-light">
                        <div class="mb-3">
                            <a href="">{{$post->category->name}}</a>
                            <span class="px-1">/</span>
                            <span>{{ $post->created_at->diffforHumans() }}</span>
                            <a href="{{route('post.edit', $post->id)}}" style="text-decoration: none; color:gray; margin-left:20px;"><i class="fas fa-pencil-alt"></i></a>
                            <form action="{{route('post.destroy', $post->id)}}" method="post" style="display:inline; position:relative;bottom:2px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                        <div>
                            <h3 class="mb-3">{{$post->title}}</h3>
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                </div>
                <!-- News Detail End -->

                <!-- Comment List Start -->
                <div class="bg-light mb-3" style="padding: 30px;">
                    <h3 class="mb-4">{{$post->comments->count()}} Comments</h3>
                    @foreach ($comments as $comment)
                    <div class="media mb-4">
                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                        <div class="media-body">
                            <h6>
                                <a href="">{{$comment->user->name}}</a>
                                <small><i>{{$comment->created_at->diffforHumans()}}</i></small>
                            </h6>
                            <div class="comment-group">
                                <span style="float: right;">
                                    <button class="btn edit-btn" data-id="{{$comment->id}}">
                                        edit
                                    </button>
                                </span>
                                <span style="float: right;">
                                    <form action="{{route('comments.destroy', $comment->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn">delete</button>
                                    </form>
                                </span>
                                <p>{{$comment->comment}}</p>
                            </div>
                            <!-- Reply Form -->
                            <div class="reply-form-{{$comment->id}}" id="reply-form-{{$comment->id}}" style="display: none; margin-top:10px;">
                                <form action="{{route('comments.replies', $comment->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </form>
                            </div>
                            <!-- Edit Reply Form L1 -->
                            <div class="edit-reply-form-{{$comment->id}}" id="reply-form-jr" style="display: none; margin-top:10px;">
                                <form action="{{route('comments.update', $comment->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" required>
                                        {{$comment->comment}}
                                        </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </form>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary reply-btn" data-id="{{$comment->id}}" id="reply-btn">Reply</button>



                            @if($comment->replies->count())
                            @foreach($comment->replies as $reply)
                            <!-- Replies -->
                            <div class="media">
                                <div class="media-body">
                                    <div class="media mt-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6><a href="">{{$reply->user->name}}</a> <small><i>{{$reply->created_at->diffforHumans()}}</i></small></h6>
                                            <div class="comment-group">
                                                <span style="float: right;">
                                                    <button class="btn edit-btn" data-id="{{$reply->id}}">
                                                        edit
                                                    </button>
                                                </span>
                                                <span style="float: right;">
                                                    <form action="{{route('comments.destroy', $reply->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn">delete</button>
                                                    </form>
                                                </span>
                                                <p>{{$reply->comment}}</p>
                                            </div>
                                            <button class="btn btn-sm btn-outline-secondary" data-id="{{$reply->id}}" id="reply-btn" onclick="toggleReply('{{$reply->id}}')">Reply</button>

                                            <!-- Reply Form JR -->
                                            <div class="reply-form-jr-{{$reply->id}}" id="reply-form-jr" style="display: none; margin-top:10px;">
                                                <form action="{{route('comments.replies', $reply->id)}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="comment" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                                </form>
                                            </div>

                                            <!-- Edit Reply Form L2 -->
                                            <div class="edit-reply-form-{{$reply->id}}" id="edit-reply-form-jr" style="display: none; margin-top:10px;">
                                                <form action="{{route('comments.update', $reply->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="comment" required>
                                                        {{$reply->comment}}
                                                        </textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                                </form>
                                            </div>

                                            @foreach($reply->replies as $miniReply)
                                            <!-- Replies -->
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="media mt-4">
                                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                        <div class="media-body">
                                                            <h6><a href="">{{$miniReply->user->name}}</a> <small><i>{{$miniReply->created_at->diffforHumans()}}</i></small></h6>
                                                            <div class="comment-group">
                                                                <span style="float: right;">
                                                                    <button class="btn edit-btn" data-id="{{$miniReply->id}}">
                                                                        edit
                                                                    </button>
                                                                </span>
                                                                <span style="float: right;">
                                                                    <form action="{{route('comments.destroy', $miniReply->id)}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="btn">delete</button>
                                                                    </form>
                                                                </span>
                                                                <p>{{$miniReply->comment}}</p>
                                                            </div>
                                                            <!-- Edit Reply Form L3 -->
                                                            <div class="edit-reply-form-{{$miniReply->id}}" id="edit-reply-form-jr" style="display: none; margin-top:10px;">
                                                                <form action="{{route('comments.update', $miniReply->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control" name="comment" required>
                                                                        {{$miniReply->comment}}
                                                                        </textarea>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <div class="bg-light mb-3" style="padding: 30px;">
                    <h3 class="mb-4">Leave a comment</h3>
                    <form action="{{route('comments.store', $post->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" name="name" class="form-control" id="name">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" name="email" id="email">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" class="form-control" name="website" id="website">
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" cols="30" rows="5" name="comment" class="form-control"></textarea>
                            @error('comment')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <input type="submit" value="Leave a comment" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                        </div>
                    </form>
                </div>
                <!-- Comment Form End -->
            </div>
            @include('home.partials.Sidebar')
        </div>
    </div>
</div>
<!-- News With Sidebar End -->
<script>
    function toggleReply(replyId) {
        $('.reply-form-jr-' + replyId).slideToggle();
    }
</script>
@endsection