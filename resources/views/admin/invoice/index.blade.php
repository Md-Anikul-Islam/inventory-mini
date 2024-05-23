@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}

    <style>
        .hidden {
            display: none;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Resource</a></li>
                        <li class="breadcrumb-item active">Invoice!</li>
                    </ol>
                </div>
                <h4 class="page-title">Resource!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Bill No</th>
                        <th>SL No</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Payment Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoice as $key=>$invoiceData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$invoiceData->bill_no}}</td>
                            <td>{{$invoiceData->serial_no}}</td>
                            <td>{{$invoiceData->customer->name}}</td>
                            <td>{{$invoiceData->customer->phone}}</td>
                            <td>{{$invoiceData->product->product_name}}</td>
                            <td>{{$invoiceData->quantity}}</td>
                            <td>{{$invoiceData->total}}</td>
                            <td>{{$invoiceData->payment_type == 'bank' ? 'Bank': 'Cash'}}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{route('invoice.destroy',$invoiceData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$invoiceData->id}}">Delete</a>
                                    <a href="{{route('invoice.show',$invoiceData->id)}}" class="btn btn-info">Invoice</a>
                                </div>
                            </td>

                            <!-- Delete Modal -->
                            <div id="danger-header-modal{{$invoiceData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$invoiceData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$invoiceData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('invoice.destroy',$invoiceData->id)}}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Add Modal -->
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('invoice.store')}}">
                        @csrf
                        <h4>Customer Section</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="name" class="form-label"> Name </label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter  Name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="phone" class="form-label"> Phone </label>
                                    <input type="text" id="phone" name="phone"
                                           class="form-control" placeholder="Enter Phone" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="phone" class="form-label"> Address </label>
                                    <textarea type="text" id="address" name="address"
                                           class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>


                        <h4>Product Section</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-0">
                                    <label for="example-select" class="form-label">Category</label>
                                    <select name="category_id" class="form-select">
                                        <option selected>Select Category</option>
                                        @foreach($category as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="product_name" class="form-label">Product Name </label>
                                    <input type="text" id="product_name" name="product_name"
                                           class="form-control" placeholder="Enter Product Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label for="description" class="form-label"> Details </label>
                                    <textarea type="text" id="description" name="description"
                                              class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="quantity" class="form-label"> Quantity </label>
                                    <input type="text" id="quantity" name="quantity"
                                           class="form-control" placeholder="Enter Quantity" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="total" class="form-label"> Total </label>
                                    <input type="text" id="total" name="total"
                                           class="form-control" placeholder="Enter Total" required>
                                </div>
                            </div>
                        </div>

                        <h4>Payment Section</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-0">
                                    <label for="payment-type" class="form-label">Payment Type</label>
                                    <select id="payment-type" name="payment_type" class="form-select">
                                        <option selected>Select Payment Type</option>
                                        <option value="bank">Bank</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 hidden" id="bank-name-section">
                                <div class="mb-2">
                                    <label for="bank-id" class="form-label">Bank Name</label>
                                    <select id="bank-id" name="bank_id" class="form-select">
                                        @foreach($bank as $bankData)
                                            <option value="{{$bankData->id}}">{{$bankData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('payment-type').addEventListener('change', function() {
            var bankSection = document.getElementById('bank-name-section');
            if (this.value === 'bank') {
                bankSection.classList.remove('hidden');
            } else {
                bankSection.classList.add('hidden');
            }
        });
    </script>
@endsection
