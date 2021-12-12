@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                <ul id="post_error_list"></ul>
                <div class="card-header">
                    <h3 class="card-title">Create new post here</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('posts.store')}}" id="create_post">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{getRandomText(100)}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea id="body" name="body" class="form-control" placeholder="Enter your post here" rows="10">{{getRandomText(1000)}}</textarea>
                        @error('body')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span class="text-danger error-text body_error"></span>
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
<?php
    function getRandomText($lenght)
    {
        $chars = "qwertyuiop asdfghjklz xcvbnmQWER TYUIOPASDF GHJKLZXCVB NMM1234567 890";
        $str = "";
        for($x=0;$x<$lenght;$x++){
            $str = $str . $chars[rand(0,strlen($chars)-1)];
        }
        return $str;
    }
?>
@endsection

