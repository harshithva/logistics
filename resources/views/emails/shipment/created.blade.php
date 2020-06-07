@component('mail::message')
# Shipment Created<br>
<img src="https://i.ibb.co/HrrpY2C/Logo-Color-Text-Below.jpg" style="width:150px;"><br>
<hr>
Hi, This Message is to inform you that your shipment with Docket number {{$data['docket_no']}} has been successfully
created.<br>
{{-- 
<table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer">
    <thead>
        <th scope="col">SL No.</th>
        <th scope="col">Description</th>
        <th scope="col">Weight</th>
        <th scope="col">Serial No.</th>
    </thead>

    @foreach ($data->package as $item)

    <tr>
        <th align="center" valign="top">1</th>
        <td align="center" valign="top">{{$item->description}}</td>
<td align="center" valign="top">{{$item->weight}} kg</td>
<td align="center" valign="top">{{$item->serial_no}}</td>
@endforeach
</table> --}}
<hr>
Thanks,<br>
{{ config('app.name') }}
@endcomponent