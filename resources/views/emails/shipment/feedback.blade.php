@extends('beautymail::templates.ark')

@section('content')

@include('beautymail::templates.minty.contentStart')

<h1>Gurukal Logistics</h1>
<br>

<p>Freight Invoice Number: {{$request->freight_invoice_number}}</p>
<h5>Feedback</h5>
<p>{{$request->feedback}}</p>



@include('beautymail::templates.minty.contentEnd')

@stop