@extends('beautymail::templates.ark')

@section('content')

@include('beautymail::templates.minty.contentStart')

<h1>Gurukal Logistics</h1>
<br>

<p>Click on the link to view your Docket.</p><br>
<a
    href="{{ENV('APP_URL')}}/customer/docket/{{$shipment->id}}/view">{{ENV('APP_URL')}}/customer/docket/{{$shipment->id}}/view</a>
<p>Regards<br>Gurukal</p>
<p>Visit: <a>https://gurukal.in</a></p>



@include('beautymail::templates.minty.contentEnd')

@stop