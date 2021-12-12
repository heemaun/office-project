@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Post</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('posts.update',$post->slug)}}" id="edit_post">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea id="body" name="body" class="form-control" rows="10">{{$post->body}}</textarea>
                        @error('body')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span class="text-danger error-text body_error"></span>
                    </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a class="btn btn-primary float-left" href="{{route('home')}}">Home</a>
                        <button type="submit" class="btn btn-primary float-end">Update Post</button>
                    </div>
                </form>
                </div>
            </div>
        </section>
    </div>
@endsection
