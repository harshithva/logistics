@extends('beautymail::templates.ark')

@section('content')

@include('beautymail::templates.ark.contentStart')

<div class="card" ref="content">
    <div class="card-body">
        <div class="row mt-2">
            <div class="col">
                {{-- <img :src="logo" style="max-width:8rem" /> --}}
            </div>
            <div class="col"></div>
            <div class="col">
                <p>
                    GURUKAL LOGISTICS
                    <br />Anchepalya, Bangalore - 560073
                    <br />Mob: +91 9620202001
                    <br />E-mail : logistics@gurukal.co.in
                    <br />Website: www.gurukal.co.in
                    <br />
                </p>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col">
                {{-- <p>Ref No: {{quote.quotation_no}}</p> --}}
            </div>
            <div class="col"></div>
            {{-- <div class="col">Date: {{ moment(quote.created_at).format('DD/MM/YYYY')}}
        </div> --}}
    </div>

    <div class="row mt-2">
        <div class="col text-center">
            <h5>
                <u>For Transit</u>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p>
                {{-- To,
            <br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{quote.customer.company_name}}
                <br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{quote.customer.address}}
                <br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{quote.customer.gst}}
                <br /> --}}
            </p>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col text-center">
            {{-- <h6>Sub: Transit Quote for {{quote.list[0].to.charAt(0).toUpperCase() + quote.list[0].to.slice(1)}}
            </h6> --}}
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <p>
                Dear Sir,
                <br />
                {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As per our discussion regarding transportation requirement for the consignment to {{quote.list[0].to.charAt(0).toUpperCase() + quote.list[0].to.slice(1)}}.
                --}}
            </p>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col text-center">
            <h5>
                <u>Quotation</u>
            </h5>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <table style="border: 1px solid black">
                <thead style="border: 1px solid black">
                    <th scope="col">SL</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Description</th>
                    <th scope="col">Size(Feet)&#38; Weight</th>
                    <th scope="col">ETA</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Advance</th>
                </thead>
                {{-- <tr v-if="quote.list" v-for="(item,index) in quote.list">
              <th scope="row">{{index+1}}</th>
                <td>{{item.from}}</td>
                <td>{{item.to}}</td>
                <td>{{item.description}}</td>
                <td>{{item.size}} & {{item.weight}}</td>
                <td>{{item.eta}} days</td>
                <td>{{item.rate}}</td>
                <td>{{item.advance}}</td>
                </tr> --}}
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <h6>Terms & Conditions</h6>
            <ol>
                <li>Rates quoted above are valid for 48Hrs only.</li>
                <li>Extra charges will be implied If the consignment exceeds the limit of fleet dimension.</li>
                <li>Advance payment is to be made (unless stated above, in which case you shall pay the quoted price).
                </li>
                <li>if the unloading time exceeds 4Hrs halting will be charged on pro rate basis.</li>
                <li>Payments are to be made within 7 days from the date of invoice.</li>
            </ol>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <p>
                Bank Details
                <br />Name : Axis Bank
                <br />8th Mile Branch
                <br />A/c No.: 918020030455515
                <br />IFSC: UTIB0002926
                <br />
            </p>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-10"></div>
        <div class="col">
            <p>For and behalf of</p>
            <img src="https://i.ibb.co/8BwTXcT/sign-rohith.png" alt="Rohith" class="img-fluid ml-3"
                style="width:4rem;" />
            <br />
            <br />

            <u>Gurukal Logistics</u>
        </div>
    </div>
</div>
</div>
@include('beautymail::templates.ark.contentEnd')

@stop