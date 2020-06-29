@extends('beautymail::templates.ark')

@section('content')


@include('beautymail::templates.widgets.articleStart')
<p>Click on the link to view your quote.</p><br>
<a
    href="{{ENV('APP_URL')}}/customer/quote/Td66URYw3EUnKUEz4xQYDKFDDBJAWhSEafjL8kLYnvJMuWVV8bgYrN2pAEGR/{{$quote->id}}/SvJAax3Avtf3u8JmnQGjBKTYSY7gfkRybzLRng53Lh3hqPtLtMt76L8udNPB/view">View
    Quote</a>
<p>Regards<br>Gurukal Logistics.</p>
<p>Visit: <a>https://gurukal.in</a></p>

@include('beautymail::templates.widgets.articleEnd')
@stop