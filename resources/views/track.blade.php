@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow p-2">
    <a class="navbar-brand ml-2" href="#">
        <img src="../dashboard/img/gurukal.png" width="120" alt />
    </a>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->

    </ul>
</nav>
<div class="container px-1 px-md-4 py-5 mx-auto" id="wrapper">
    <h1 class="card-title text-center">Shipment Status</h1>
    <div class="card">

        <div class="card-body">
            <tracking-component></tracking-component>
        </div>
    </div>

    <footer class="text-center mt-4">
        <p class="terms-conditions">© 2020 All Rights Reserved. <a href="{{url('/')}}">Gurukal</a><br>

    </footer>

</div>

@endsection