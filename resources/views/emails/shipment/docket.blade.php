@extends('beautymail::templates.ark')

@section('content')

@include('beautymail::templates.minty.contentStart')

<h1>Gurukal Logistics</h1>
<br>

<p>Click on the link to view your Docket.</p><br>
<a
    href="{{ENV('APP_URL')}}/customer/docket/8jZSqbGNmzk25EcBgMsWYyDP4LDEAS7amrVevmqcTE67ByuajGaks8UqmLmJ/{{$shipment->id}}/urMrnM6JNuGPCnEdnmDqzfWfDYAUSYb8rkveHF9mWGPgD2XxH4SYRXjRCnmx/view">View
    Docket</a>
<p>Regards<br>Gurukal</p>
<p>Visit: <a>https://gurukal.in</a></p>



@include('beautymail::templates.minty.contentEnd')

@stop