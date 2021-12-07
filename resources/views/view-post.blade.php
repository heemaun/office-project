@extends('layouts.app')
@section('mytitle', ' | '.$post->title)
@section('content')

    {{-- <div class="container"> --}}
        <section class="content">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card text-white bg-secondary">
                <div class="card-header">
                    <h1 class="card-title">{{$post->title}}</h1>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <p>
                        {{$post->body}}
                    </p>
                </div>
                <div class="card-footer">
                    <h6>Author: {{$post->user->name}}</h6>
                    Posted at: {{ $post->created_at->format('l, F-d,Y H:i A')}} <br>
                    <a href="{{route('home')}}" class="btn btn-info">Home</a>
                    @can('edit post')
                    <a id="edit" href="{{route('posts.edit',$post->slug)}}" class="btn btn-info">Edit</a>
                    @endcan
                    @can('delete post')
                    <td>
                        <form method="POST" action="{{route('posts.destroy',$post->slug)}}">
                            @method("DELETE")
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    @endcan
                </div>
                </div>
                @can('comment')
                <div class="card text-white bg-secondary col-md-12">
                    <div class="card-body ">
                        <form method="POST" action="{{route('comments.store',['post_id'=>$post->id])}}" id="add-cmt">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" id="text" name="text" placeholder="Put your comments here">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info float-right" type="submit" id="cmt-btn" name="cmt-btn">Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endcan

                <div class="col-md-12">
                    @foreach ($post->comments as $c)
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <strong>{{$c->user->name}}</strong>
                            <p class="float-end">{{$c->text}}</p><br>
                        {{-- </div>
                        <div class="card-footer"> --}}
                            {{$c->created_at->format('D, M-d,Y H:i:s')}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    {{-- </div> --}}
@endsection
