<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gurukal- Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <script src="{{asset('css/app.css')}}"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="container-fluid">

            <div class="row mt-3 mb-3 ml-3 d-print-none">
                <div class="col-6"></div>
                <div class="col-3"></div>
                <div class="col-3">
                    <a class="btn btn-primary text-white" onclick="javascript:window.print()">
                        <i class="fas fa-print"></i> Print
                    </a>

                </div>
            </div>
            <div class="card" ref="content">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col">
                            <img src="https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg" style="max-width:8rem" />
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
                            <p>Ref No: {{$quote->quotation_no}}</p>
                        </div>
                        <div class="col"></div>
                        <div class="col">Date: {{ date_format($quote->created_at,"d/m/Y")}}
                        </div>
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
                                To,
                                <br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$quote->customer->company_name}}
                                <br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$quote->customer->address}}
                                <br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$quote->customer->gst}}
                                <br />
                            </p>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col text-center">
                            <h6>Sub: Transit Quote for {{$quote->list[0]->to}}</h6>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <p>
                                Dear Sir,
                                <br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As
                                per
                                our discussion regarding transportation requirement for the consignment to
                                {{$quote->list[0]->to}}.
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
                            <table class="table-bordered table table-responsive-sm">
                                <thead>
                                    <th scope="col">SL</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Size(Feet)&#38; Weight</th>
                                    <th scope="col">ETA</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Advance</th>
                                </thead>
                                @foreach ($quote->list as $item)

                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{$item->from}}</td>
                                    <td>{{$item->to}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->size}} & {{$item->weight}}</td>
                                    <td>{{$item->eta}} days</td>
                                    <td>{{$item->rate}}</td>
                                    <td>{{$item->advance}}</td>
                                </tr>

                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <h6>Terms & Conditions</h6>
                            <ol>
                                <li>Rates quoted above are valid for 48Hrs only.</li>
                                <li>Extra charges will be implied If the consignment exceeds the limit of fleet
                                    dimension.
                                </li>
                                <li>Advance payment is to be made (unless stated above, in which case you shall pay the
                                    quoted
                                    price).</li>
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


        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('dashboard/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->


    <!-- Page level custom scripts -->


    <script src="{{asset('js/app.js')}}"></script>

</body>