{{-- @component('mail::message')
# Shipment Created<br>
<img src="https://i.ibb.co/HrrpY2C/Logo-Color-Text-Below.jpg" style="width:150px;"><br>
<hr>
Hi, This Message is to inform you that your shipment with Docket number {{$docket}} has been successfully
created.<br>

<hr>
Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}


@extends('beautymail::templates.ark')

@section('content')

@include('beautymail::templates.widgets.articleStart', [
'heading' => 'Gurukal Logistics',
'level' => 'h1'
])

<p>Click on the link to view your Docket.</p><br>
<a
    href="{{ENV('APP_URL')}}/customer/docket/{{$shipment->id}}/view">{{ENV('APP_URL')}}/customer/docket/{{$shipment->id}}/view</a>
<p>Regards<br>Gurukal</p>
<p>Visit: <a>https://gurukal.in</a></p>



@include('beautymail::templates.widgets.newfeatureEnd')

@stop