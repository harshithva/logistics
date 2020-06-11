@extends('beautymail::templates.ark')

@section('content')

@include('beautymail::templates.ark.heading', [
'heading' => 'Hello World!',
'level' => 'h1'
])

@include('beautymail::templates.ark.contentStart')

<h4 class="secondary"><strong>Hello World</strong></h4>
<p>{{$data}}</p>

@include('beautymail::templates.ark.contentEnd')

@include('beautymail::templates.ark.heading', [
'heading' => 'Another headline',
'level' => 'h2'
])

@include('beautymail::templates.ark.contentStart')

<h4 class="secondary"><strong>Hello World again</strong></h4>
<p>This is another test</p>

@include('beautymail::templates.ark.contentEnd')

@stop