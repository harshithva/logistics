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
                    <div class="row">
                        <div class="col">
                            <p>GST No: 29AYGPS3509N2ZQ</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <img src="https://i.ibb.co/WFdrW4M/Logo-Color-Text-Below.jpg" style="max-width:10rem" />
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <h5 style="font-size:2rem">
                                <b>FREIGHT INVOICE</b>
                            </h5>
                        </div>
                    </div>
                    <div class="row mt-4">
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
                        <div class="col"></div>
                        <div class="col">
                            <p style="font-size:1.3rem">
                                <b>Invoice No: {{$shipment->freight_invoice_number}}</b>
                            </p>
                            <p>Date of Invoice: {{ $shipment->date}}</p>

                            <p>Transaction Type</p>
                            <p>
                                <span
                                    class="badge badge-pill badge-success">{{$shipment->package_transaction_type}}</span>
                            </p>

                        </div>
                    </div>
                    <hr />

                    <div class="row mt-2">
                        <div class="col">
                            <p>BILL TO</p>

                            @if ($shipment->bill_to == 'consignor')
                            <p>
                                {{$shipment->sender->company_name}}
                                <br />
                                {{$shipment->sender->address}}
                            </p>

                            @elseif($shipment->bill_to == 'consignee')
                            <p>
                                {{$shipment->receiver->company_name}}
                                <br />
                                {{$shipment->receiver->address}}
                            </p>

                            @else

                            <p>
                                {{$shipment->sender->company_name}}
                                <br />
                                {{$shipment->sender->address}}
                            </p>
                            @endif




                        </div>

                        <div class="col font-dark">
                            Consignor Name:
                            <br />
                            {{$shipment->sender->company_name}}
                            <br />
                            {{$shipment->sender->address}}
                            <br />
                            GST: {{$shipment->sender->gst}}
                        </div>
                    </div>

                    <div class="row mt-2 font-dark">
                        <div class="col"></div>
                        <div class="col">
                            <p>
                                Consignee Name:
                                <br />
                                {{$shipment->receiver->company_name}}
                                <br />
                                {{$shipment->receiver->address}}
                                <br />
                                GST: {{$shipment->receiver->gst}}
                            </p>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-8">
                            <table class="table-bordered table font-dark">
                                <thead>
                                    <th scope="col">SL No.</th>
                                    <th scope="col" style="width:20rem">Description</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Serial No.</th>
                                    <th scope="col">Docket No.</th>
                                </thead>

                                @foreach ($shipment->package as $key => $item)
                                <tr v-for="item in ">
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->weight}} kg</td>
                                    <td>{{$item->serial_no}}</td>
                                    <td>{{$shipment->docket_no}}</td>
                                </tr>
                                @endforeach
                            </table>

                            <table class="table-bordered table font-dark" style>
                                <tr>
                                    <th scope="row">Advance Paid</th>
                                    <td>{{$shipment->charge_advance_paid}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Balance Amount</th>
                                    <td>{{$balance_amount}}</td>
                                </tr>
                            </table>

                            <h6 class="mt-4">Remarks</h6>
                            <p>{{$shipment->remarks}}</p>
                        </div>
                        <div class="col">
                            <table class="table-bordered table font-dark">
                                <!-- <thead>
                          <th scope="col" colspan="4" class="text-center">Amount</th>
                        </thead>-->
                                <tr>
                                    <th scope="row">Transportation</th>
                                    <td>{{$shipment->charge_transportation}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Handling</th>
                                    <td>{{$shipment->charge_handling}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">ODC Charges</th>
                                    <td>{{$shipment->charge_odc}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Halting</th>
                                    <td>{{$shipment->charge_halting}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Insurance</th>
                                    <td>{{$shipment->charge_Insurance}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">GST</th>
                                    <td>{{$shipment->charge_tax_amount}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>{{$shipment->charge_total}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col font-dark">
                            <h6>Terms & Conditions</h6>
                            <ol>
                                <li>Remittance of payment within 7 days of invoice receipt.</li>
                                <li>A 10 % charge will be applied for every month of late payment.</li>
                                <li>GST Payable by Freight Bearer</li>
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
                        <div class="col-6"></div>
                        <div class="col">
                            <p>For and behalf of</p>
                            {{-- <img src="https://i.ibb.co/W6vkYqs/seal.png" alt="Rohith" class="img-fluid ml-3"
                                style="width:6rem;" /> --}}
                            <br />
                            <br />

                            <u>Gurukal Logistics</u>
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