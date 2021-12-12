@extends('layouts.app')
@section('mytitle', ' | Send Mail')
@section('content')


<div class="container">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12 card">
            <form action="{{route('send.mail',['email'=>Auth::user()->email])}}" method="POST" id="create_email">
                @csrf
                <legend class="card-header">Send your mail from here</legend>
                <div class="card-body form-group">
                    <label for="name">Choose a reciever</label>
                    <select name="names" id="names" class="form-control" >
                        @foreach ($users as $user)
                            @if (Auth()->user()->id !== $user->id)
                                <option value="{{$user->email}}">{{$user->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="body">Write your mail here</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10" placeholder="enter your mail text here"></textarea>
                    @error('body')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <span class="text-danger error-text body_error" id="body_error"></span>
                </div>
                <div class="card-footer">
                    <a href="{{route('home')}}" class="btn btn-info">Home</a>
                    <button class="btn btn-success float-end" type="submit">Send mail</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if (Session::has('email_send'))
    <script>
        toastr.options = {
            "positionClass": "toast-bottom-left"
        }
        toastr.success("{!! Session::get('email_send') !!}")
    </script>
    {{session::forget('email_send')}}
@endif
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


