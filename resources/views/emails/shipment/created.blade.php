@extends('beautymail::templates.ark')

@section('content')

@include('beautymail::templates.minty.contentStart')

@if ($status == 'Awaiting pickup' || $status == 'Awaiting Pickup')
<h1>Gurukal Logistics</h1>
<br>
<h4 class="secondary"><strong>Shipment Created</strong></h4>
<br>
<p>Your Consignment is ready for dispatch with docket number {{$docket}}.<br> Login at gurukal.in Or
    track your consignment at https://crm.gurukal.in/track <br>

    <p>Regards<br>Gurukal</p>



    @elseif ($status == 'Dispatched')
    <h4 class="secondary"><strong>Shipment Dispatched</strong></h4>
    <br>
    <p>Your Consignment with docket number {{$docket}} is Dispatched.<br> Login at gurukal.in Or track
        your consignment at https://crm.gurukal.in/track<br>Gurukal Logistics.</p>


    @elseif ($status == 'Delivered')
    <h4 class="secondary"><strong>Shipment Delivered</strong></h4>
    <br>
    <p>Your Consignment with docket number {{$docket}} is DELIVERED. <br>Kindly let us know how was your
        experience by clicking the following link https://crm.gurukal.in/customer/feedback/{{$shipment->id}}<br>
        <p>Click on the link to view invoice.</p><br>
        <a
            href="https://crm.gurukal.in//customer/invoice/XSFQqLeeNrRTQjK95ea7mnkGbU74eLUEets272Lq2nnSXkEfLkYtAxtgfz2B/{{$shipment->id}}/y8NRkCN4X9pHh6RM327hZTRd9ErSgmWd4P6zB52mZJLT9rqry7pVU6tzf6L8/view">View
            Invoice
        </a>
        Thank you.<br> Regards Gurukal Logistics.
    </p>


    @elseif ($status == 'Intransit' || $status == 'Intrasit')
    <h4 class="secondary"><strong>Shipment Intransit</strong></h4>
    <br>
    <p>Your Consignment with docket number {{$docket}} is Intransit.<br>Regards Gurukal
        Logistics.</p>

    @else
    <h4 class="secondary"><strong>Shipment Created</strong></h4>
    <br>
    <p>Your Consignment is ready for dispatch with docket number {{$docket}}.<br> Login at gurukal.in Or
        track your consignment at https://crm.gurukal.in/track <br>Regards Gurukal Logistics.</p>
    @endif

    @include('beautymail::templates.minty.contentEnd')

    @stop