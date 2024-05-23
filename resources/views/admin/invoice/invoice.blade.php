<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{asset('invoice/bootstrap.min.css')}}">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900">
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('invoice/style.css')}}">
    <!-- Font Awesome -->
    <script src="{{asset('invoice/fontAwesome.js')}}"></script>
    <style>
        .invoice-1 .invoice-logo {
            padding: 10px 50px;
        }
    </style>
</head>
<body>
<div class="invoice-1 invoice-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner clearfix">
                    <div class="invoice-info clearfix" id="invoice_wrapper">
                        <div class="invoice-headar">
                            <div class="row g-0">
                                <h1 class="text-center inv-header-1 invoice_text">Invoice</h1>
                                <div class="col-6">
                                    <div class="invoice-logo">
                                        <!-- logo started -->
                                        <div class="logo">
                                           <img src="{{URL::to('invoice/rar.png')}}" style="height: 100px;">
                                        </div>
                                        <!-- logo ended -->
                                    </div>
                                </div>
                                <div class="col-6 invoice-id">
                                    <div class="info">
                                        <h1 class="color-white inv-header-1 invoice_text_none">Invoice</h1>
                                        <p class="color-white mb-1">Invoice <span>#{{$invoice->serial_no}}</span></p>
                                        <p class="color-white mb-0">Date <span>{{date('d-m-Y', strtotime($invoice->created_at))}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-top">
                            <div class="row">
                                <div class="col-6">
                                    <div class="invoice-number mb-30">
                                        <h4 class="inv-title-1">Invoice To</h4>
                                        <h2 class="name mb-10">{{$invoice->customer->name}}</h2>
                                        <p class="invo-addr-1">
                                            {{$invoice->customer->phone}} <br>
                                            {{$invoice->customer->address}} <br>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="invoice-number mb-30">
                                        <div class="invoice-number-inner">
                                            <h4 class="inv-title-1">Invoice From</h4>
                                            <h2 class="name mb-10">RARAR</h2>
                                            <p class="invo-addr-1">rumman.rarar@gmail.com<br>
                                                +8801717553669 <br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-center">
                            <div class="table-responsive">
                                <table class="table mb-0 table-striped invoice-table">
                                    <thead class="bg-active">
                                    <tr class="tr">
                                        <th>No.</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Product Details</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="tr">
                                        <td>
                                            <div class="item-desc-1">
                                                <span>{{$invoice->id}}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">{{$invoice->product->product_name}}</td>
                                        <td class="text-center">{{$invoice->product->description}}</td>
                                        <td class="text-center">৳{{$invoice->total}}</td>
                                        <td class="text-center">{{$invoice->quantity}}</td>
                                        <td class="text-end">৳{{$invoice->total}}</td>
                                    </tr>

                                    <tr class="tr2">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center f-w-600 active-color">Grand Total</td>
                                        <td class="f-w-600 text-end active-color">৳{{$invoice->total*$invoice->quantity}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-bottom">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-30 dear-client">
                                        <h3 class="inv-title-1">Terms &amp; Conditions</h3>
                                        <p>If more than one (1) sample of the same tile item code is ordered, the Company reserves the right to send only one (1) sample of that tile in the delivery.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="invoice-contact clearfix">
                            <div class="row g-0">
                                <div class="col-lg-9 col-md-11 col-sm-12">
                                    <div class="contact-info">
                                        <a href="#"><i class="fa fa-phone"></i> +8801717553669</a>
                                        <a href="https://rarar.com.bd/"><i class="fa fa-globe"></i> www.rarar.com.bd</a>
                                        <a href="#" class="mr-0 d-none-580"><i class="fa fa-map-marker"></i> 2/2, R. K. Mission Road, (1st Floor) Ittefaq Mor, Beside Inqilab Bhaban, Opposite of Desh Bondhu Restaurant, Dhaka-1203.</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-btn-section clearfix d-print-none">
                        <a href="javascript:window.print()" class="btn btn-lg btn-print">
                            <i class="fa fa-print"></i> Print Invoice
                        </a>
                        <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                            <i class="fa fa-download"></i> Download Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('invoice/jquery.min.js')}}"></script>
<script src="{{asset('invoice/jspdf.min.js')}}"></script>
<script src="{{asset('invoice/html2canvas.js')}}"></script>
<script src="{{asset('invoice/app.js')}}"></script>
</body>
</html>
