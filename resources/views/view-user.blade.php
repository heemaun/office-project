@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{route('user.update',['id'=>$user->id])}}" class="form-group">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Enter name here" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input disabled class="form-control" type="email" id="email" name="email" value="{{$user->email}}">
                        </div>
                        <select name="roles" id="roles" class="form-select" aria-label="Default select example">
                            <option
                            @if ($user->hasRole('admin'))
                            selected
                            @endif
                            value="admin">Admin</option>
                            <option
                            @if ($user->hasRole('writer'))
                            selected
                            @endif
                            value="writer">Writer</option>
                            <option
                            @if ($user->hasRole('editor'))
                            selected
                            @endif
                             value="editor">Editor</option>
                            <option
                            @if ($user->hasRole('user'))
                            selected
                            @endif
                             value="user">User</option>
                        </select>
                        <div class="form-control">
                            <a href="{{route('home')}}" class="btn btn-info">Home</a>
                            <button type="submit" class="btn btn-success float-end" onclick="return confirm('are your sure?')">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
