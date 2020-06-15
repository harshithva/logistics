@extends('layouts.app')

@section('content')

<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content" id="wrapper">
                    <h1 class="">Log In to <a href="{{url('/')}}"><span class="brand-name">Gurukal</span></a></h1>
                    <p class="signup-link">New Here? <a href="{{route('register')}}">Create an account</a></p>
                    <Login></Login>
                    <div class="container mt-4 text-center">
                        <a href="{{route('track')}}" class="btn btn-outline-primary mt-4 text-center">Track Shipment</a>
                    </div>

                    <p class="terms-conditions">© 2020 All Rights Reserved. <a href="{{url('/')}}">Gurukal</a><br>
                        <a href="{{url('https://vawebsites.in')}}" target="_blank">Powered by VAwebsites</a></p>

                </div>
            </div>
        </div>
    </div>
    <div class="form-image">

        <div class="l-image">

        </div>
    </div>
</div>
@endsection