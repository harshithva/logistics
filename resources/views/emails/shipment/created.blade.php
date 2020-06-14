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

@if ($status == 'Awaiting Pickup')
<h4 class="secondary"><strong>Shipment Created</strong></h4>
<br>
<p>Your Consignment is ready for dispatch with docket number {{$docket}}.<br> Login at gurukal.in Or
    track your consignment at Gurukal.co.in <br>Regards Gurukal Logistics.</p>

@endif

@if ($status == 'Dispatched')
<h4 class="secondary"><strong>Shipment Dispatched</strong></h4>
<br>
<p>Your Consignment with docket number {{$docket}} is Dispatched.<br> Login at gurukal.in Or track
    your consignment at Gurukal.co.in<br> Regards Gurukal Logistics.</p>
@endif

@if ($status == 'Delivered')
<h4 class="secondary"><strong>Shipment Delivered</strong></h4>
<br>
<p>Your Consignment with docket number {{$docket}} is DELIVERED. <br>Kindly let us know how was your
    experience by clicking the following link Gurukal.in/feedback Thank you.<br> Regards Gurukal Logistics.</p>
@endif

@if ($status == 'Instrasit')
<h4 class="secondary"><strong>Shipment Intransit</strong></h4>
<br>
<p>Your Consignment with docket number {{$docket}} is Intransit.<br>Regards Gurukal
    Logistics.</p>
@endif


@include('beautymail::templates.widgets.newfeatureEnd')

@stop