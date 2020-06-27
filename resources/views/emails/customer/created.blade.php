@extends('beautymail::templates.ark')

@section('content')

@include('beautymail::templates.minty.contentStart')

<h1>Gurukal Logistics</h1>
<br>
<h4>Customer Account has been created.</h4>
<p>You can login at: https://crm.gurukal.in</p>
<p>Your Email Address for login: {{$request->email}}</p>
<p>Your Password: {{$request->password}}</p>
<p>You can reset your password here: https://crm.gurukal.in/password/reset</p>
<br>
<p>Regards<br>Gurukal</p>
<p>Visit: <a>https://gurukal.in</a></p>


@include('beautymail::templates.minty.contentEnd')

@stop