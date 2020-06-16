@extends('beautymail::templates.ark')

@section('content')


@include('beautymail::templates.widgets.articleStart')
<p>Click on the link to view your quote.</p><br>
<a
    href="{{ENV('APP_URL')}}/customer/quote/{{$quote->id}}/view">{{ENV('APP_URL')}}/customer/quote/{{$quote->id}}/view</a>
<p>Regards<br>Gurukal Logistics.</p>
<p>Visit: <a>https://gurukal.in</a></p>

@include('beautymail::templates.widgets.articleEnd')
@stop