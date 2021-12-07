@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Quick Example</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('posts.store')}}">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea id="body" name="body" class="form-control" placeholder="Enter your post here" rows="10"></textarea>
                    </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a class="btn btn-primary float-left" href="{{route('home')}}">Home</a>
                        <button type="submit" class="btn btn-primary float-end">Add Post</button>
                    </div>
                </form>
                </div>
            </div>
        </section>
    </div>
@endsection

