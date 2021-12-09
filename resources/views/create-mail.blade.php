@extends('layouts.app')
@section('mytitle', ' | Send Mail')
@section('content')


<div class="container">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12 card">
            <form action="{{route('send.mail',['email'=>Auth::user()->email])}}" method="POST">
                @csrf
                <legend class="card-header">Send your mail from here</legend>
                <div class="card-body form-group">
                    <label for="name">Choose a reciever</label>
                    <select name="names" id="names" class="form-control" >
                        @foreach ($users as $user)
                        <option value="{{$user->email}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    <label for="body">Write your mail here</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10" placeholder="enter your mail text here"></textarea>
                </div>
                <div class="card-footer">
                    <a href="{{route('home')}}" class="btn btn-info">Home</a>
                    <button class="btn btn-success float-end" type="submit">Send mail</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


