@extends('layouts.admin')

@section('title', 'ALa Cart Orders')

@section('header')

@endsection

@section('content')


@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))
<div class="col-sm-12">
    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
</div>
@endif
@endforeach

@if(Request::is('order/alacart'))
<div class=" col-sm-12 text-right">
    <a href="{{url('/order/alacart/failed')}}" class="btn btn-danger btn-lg m-4 has-ripple">
        <i class="fas fa-times"></i>
        Failed Transactions
    </a>
</div>
@endif



<!-- table section -->

<div class="col-sm-12 mt-3">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h5>Ala Cart</h5>
            </div>
            @if(Request::is('order/alacart/today'))            
            <div class="card-toolbar">
                <a href="{{url('/print/alacart')}}" class="btn btn-primary">Print All Labels</a>
            </div>
            @endif
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="tabdata" class="table table-striped table-bordered nowrap">
                    <thead>
                        @php($i = 1)
                        <tr class="text-center">
                            <th>Sr.no</th>
                            @if(Request::is('order/alacart'))
                            <th>Transaction Id</th>
                            <th>Order Total</th>
                            <th>Delivery Charges</th>
                            <th>Discount</th>
                            <th>GST</th>
                            @endif
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Total</th>
                            <th>Address</th>
                            <th>Pincode</th>
                            <th>Area</th>
                            <th>Landmark</th>
                            <th>City</th>
                            <th>Delivery Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alacartorders as $data )
                        <tr>
                            <td class="align-middle text-center">{{$i++}}</td>
                            @if(Request::is('order/alacart'))
                            <td class="align-middle text-center">{{$data->id}}</td>
                            <th class="align-middle text-center">{{$data->subtotalamt}}</th>
                            <th class="align-middle text-center">{{$data->deliveryamt}}</th>
                            <th class="align-middle text-center">{{$data->discountamt}}</th>
                            <th class="align-middle text-center">{{$data->gstamt}}</th>
                            @endif
                            <td class="align-middle text-center">{{$data->cpname}}</td>
                            <td class="align-middle text-center">{{$data->cpno}}</td>
                            <td class="align-middle text-center">{{$data->finalamt}}</td>
                            <td class="align-middle text-center">{{$data->address}}</td>
                            <td class="align-middle text-center">{{$data->pincode}}</td>
                            <td class="align-middle text-center">{{$data->area}}</td>
                            <td class="align-middle text-center">{{$data->landmark}}</td>
                            <td class="align-middle text-center">{{$data->city}}</td>
                            <td class="align-middle text-center">{{$data->deliverystatus}}
                                <a href="" class="btn btn-icon has-ripple" data-toggle="modal" data-target="#changeStatus{{$data->id}}" title="Cancel Product"><i class="fas fa-edit"></i></a>
                            </td>
                            <td class="table-action text-center">
                                <div>
                                    <a href="" class="btn btn-icon btn-outline-success has-ripple" data-toggle="modal" data-target="#viewLabelModal{{$data->id}}"><i class="fas fa-file-invoice"></i></a>
                                    <a href="" class="btn btn-icon btn-outline-warning has-ripple" data-toggle="modal" data-target="#viewModal{{$data->id}}"><i class="fas fa-eye"></i></a>
                                    <!-- <a href="" class="btn btn-icon btn-outline-danger has-ripple" data-toggle="modal" data-target="#deleteModal{{$data->id}}"><i class="far fa-trash-alt"></i></a> -->
                                </div>
                            </td>
                        </tr>

                        <!--View Label Modal -->
                        <div class="modal fade" id="viewLabelModal{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Print Label</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times" style="font-size: 25px; "></i>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="printLabelBody{{$data->id}}">
                                        <div class="labelContents" style="max-width: 430px; border: 2px solid #000; padding: 10px; border-radius: 10px; ">
                                            <div class="row g-2">

                                                <div class="col-9">
                                                    <picture>
                                                        <img src="/webassets/images/logo.png" class="img-fluid" alt="image desc">
                                                    </picture>
                                                </div>
                                                <div class="col-3" style="display: flex; align-items: center;">
                                                    {{ date('d M Y', strtotime($data->created_at)) }}
                                                </div>
                                                <div class="col-12 mt-2" style="display: flex; align-items: center;">
                                                    <h6 for="">Poonam Kapur Healthy Kitchen</h6>
                                                </div>
                                                <div class="col-3 mt-5">
                                                    <h6 for="">Order No </h6>
                                                </div>
                                                <div class="col-9 mt-5">
                                                    <p for="">{{$data->id}}</p>
                                                </div>
                                                <div class="col-3">
                                                    <h6 for="">Name </h6>
                                                </div>
                                                <div class="col-9">
                                                    <p for="">{{$data->cpname}}</p>
                                                </div>
                                                <div class="col-3">
                                                    <h6 for="">Phone </h6>
                                                </div>
                                                <div class="col-9">
                                                    <p for="">{{$data->cpno}}</p>
                                                </div>
                                                <div class="col-3">
                                                    <h6 for="">Address </h6>
                                                </div>
                                                <div class="col-9">
                                                    <p for="">{{$data->address}}, {{$data->area}},{{$data->pincode}} </p>
                                                </div>
                                                <div class="col-3">
                                                    <h6 for="">Landmark </h6>
                                                </div>
                                                <div class="col-9">
                                                    <p for="">{{$data->landmark}} </p>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>

                                                <div class="col-10">
                                                    <h5 for="">Order </h5>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <h5 for="">Qty </h5>
                                                </div>
                                                @foreach($data->trxalacartorder as $key=>$orderdetails)

                                                <div class="col-11">
                                                    <p for="">{{$key+1}}) {{$orderdetails->productName}} </p>
                                                    @if($orderdetails->addonName != null)
                                                    <span style="padding-left: 25px;" for=""> [{{$orderdetails->addonName}}] </span>
                                                    @endif
                                                </div>
                                                <div class="col-1">
                                                    <p for="">x{{$orderdetails->qty}} </p>
                                                </div>

                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" onclick="printLabel('{{$data->id}}')" class="btn btn-primary">
                                            <i class="fas fa-print" style="font-size: 20px;"></i>Print
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End View Label modal -->

                        <!--View Modal -->
                        <div class="modal fade" id="viewModal{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Update Order</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times" style="font-size: 25px; "></i>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="color: black;">
                                        <div class="row">
                                            <div class="col-3 text-center" style="border: 1px solid #000;">Product</div>
                                            <div class="col-1 text-center" style="border: 1px solid #000;">Price</div>
                                            <div class="col-1 text-center" style="border: 1px solid #000;">Quantity</div>
                                            <div class="col-3 text-center" style="border: 1px solid #000;">Addon</div>
                                            <div class="col-1 text-center" style="border: 1px solid #000;">Price</div>
                                            <div class="col-2 text-center" style="border: 1px solid #000;">Status</div>
                                            <div class="col-1 text-center" style="border: 1px solid #000;">Action</div>
                                        </div>
                                        @foreach($data->trxalacartorder as $key=>$orderdetails)
                                        <div class="row">
                                            <div class="col-3 text-center" style="border: 1px solid #000;">{{$orderdetails->productName}}</div>
                                            <div class="col-1 text-center" style="border: 1px solid #000;">{{$orderdetails->productPrice}}</div>
                                            <div class="col-1 text-center" style="border: 1px solid #000;">{{$orderdetails->qty}}</div>
                                            <div class="col-3 text-center" style="border: 1px solid #000;">{{$orderdetails->addonName}}</div>
                                            <div class="col-1 text-center" style="border: 1px solid #000;">{{$orderdetails->addonprice}}</div>
                                            <div class="col-2 text-center" style="border: 1px solid #000;"> <span id="orderstatus{{$orderdetails->id}}">{{$orderdetails->status}}</span> </div>
                                            <div class="col-1 text-center" style="border: 1px solid #000;">
                                                <a href="" class="btn btn-icon has-ripple" data-toggle="modal" onclick="getProductId('{{$orderdetails->id}}')" data-target="#cancel{{$orderdetails->id}}" title="Cancel Product"><i class="fas fa-times"></i></a>
                                            </div>
                                        </div>

                                        <!--Cancel Modal -->
                                        <div class="modal fade" id="cancel{{$orderdetails->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Confirmation</h5>
                                                        <button type="button" class="close" onclick="closeModal('{{$orderdetails->id}}')">
                                                            <i class="fas fa-times" style="font-size: 25px; "></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" id="userId{{$orderdetails->id}}" value="{{$data->userId}}">
                                                        <p style="color: black;"> Are you sure you want to cancel this Product? <br> <b>REFUND PROCESS WILL BE INITIATED</b> </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                        <button type="button" id="cancelProduct{{$orderdetails->id}}" class="btn btn-primary">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Cancel modal -->


                                        @endforeach
                                        <!-- <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label style="font-weight: bold;" for="role">Status <span style="color: red;">&#42</span></label>
                                                    <select class="form-control selectpicker" id="status">
                                                        <optgroup label="Status">
                                                            <option value="completed" {{$data->status == 'completed' ? 'selected' : ''}}>Completed</option>
                                                            <option value="pending" {{$data->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div> -->

                                    </div>
                                    <!-- <div class="col-sm-12 modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Update
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- End View Modal -->

                        <!--Status Modal -->
                        <div class="modal fade" id="changeStatus{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Change Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times" style="font-size: 25px; "></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="hiddenId" value="{{$data->id}}">
                                    <form action="{{url('/order/status')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="hiddenId" value="{{$data->id}}">
                                        <div class="modal-body">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label style="font-weight: bold;" for="role">Status <span style="color: red;">&#42</span></label>
                                                    <select class="form-control selectpicker" name="status" id="status">
                                                        <optgroup label="Status">
                                                            <option value="Completed" {{$data->deliverystatus == 'Completed' ? 'selected' : ''}}>Completed</option>
                                                            <option value="InProcess" {{$data->deliverystatus == 'InProcess' ? 'selected' : ''}}>InProcess</option>
                                                            <option value="Pending" {{$data->deliverystatus == 'Pending' ? 'selected' : ''}}>Pending</option>
                                                            <option value="Cancelled" {{$data->deliverystatus == 'Cancelled' ? 'selected' : ''}}>Cancelled</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Status modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    function getProductId(id) {
        console.log(id);

        $('#cancelProduct' + id).click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{url('/order/alacart/cancel')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    userId: $('#userId' + id).val(),
                },
                dataType: "json",
                success: function(response) {
                    // close modal
                    $('#cancel' + id).modal('hide');
                    // toast
                    toastr.success('Order Cancelled Successfully');
                    // reload div
                    $('#orderstatus' + id).load(document.URL + ' #orderstatus' + id);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    }

    function closeModal(id) {
        $('#cancel' + id).modal('hide');
    }
</script>

<script>
    function printLabel(id) {
        var divContents = $('#printLabelBody' + id).html();
        var printWindow = window.open('', '', 'height=400,width=800');
        printWindow.document.write('<html><head><title>Print Label</title>');
        printWindow.document.write('<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />');
        printWindow.document.write('<style>');
        printWindow.document.write('body{padding: 10px; background: #fff} ');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

@endsection