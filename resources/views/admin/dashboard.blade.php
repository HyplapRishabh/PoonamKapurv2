@extends('layouts.admin')

@section('title')
DashBoard
@endsection

@section('header')
<link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card card-custom gutter-b text-start">
            <div class="card-header">
                <h4 class="card-title">Total Subscription Orders</h4>
            </div>
            <div class="card-body">
                <p class="card-text" style="font-size: 50px; font-weight: 600;">{{$subsOrders}}</p>
                <div class="" style="display: flex; align-items: center; justify-content: space-between;">
                    <h6>Active KT orders</h6> 
                    <p style="font-size: large;" >{{$packageorderscount}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom gutter-b text-start">
            <div class="card-header">
                <h4 class="card-title">Total Alacart Orders</h4>
            </div>
            <div class="card-body">
                <p class="card-text" style="font-size: 50px; font-weight: 600;">{{$alacartOrders}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom gutter-b text-start">
            <div class="card-header">
                <h4 class="card-title">Total Users</h4>
            </div>
            <div class="card-body">
                <p class="card-text" style="font-size: 50px; font-weight: 600;">{{$endusers}}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 text-right">
        <a href="{{url('/print/all')}}" class="btn btn-primary" >Print All Labels</a>
    </div>
</div>

<div class="col-sm-12 mt-3">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h5>Ala Cart</h5>
            </div>
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
                                    <!-- <a href="" class="btn btn-icon btn-outline-success has-ripple" data-toggle="modal" data-target="#viewLabelModal{{$data->id}}"><i class="fas fa-file-invoice"></i></a> -->
                                    <a href="" class="btn btn-icon btn-outline-warning has-ripple" data-toggle="modal" data-target="#viewModal{{$data->id}}"><i class="fas fa-eye"></i></a>
                                    <!-- <a href="" class="btn btn-icon btn-outline-danger has-ripple" data-toggle="modal" data-target="#deleteModal{{$data->id}}"><i class="far fa-trash-alt"></i></a> -->
                                </div>
                            </td>
                        </tr>

                        <!--View Label Modal -->
                        <!-- <div class="modal fade" id="viewLabelModal{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        </div> -->
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

<div class="col-sm-12 mt-3">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h5>Subscription</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="tabdata2" class="table table-striped table-bordered nowrap">
                    <thead>
                        @php($i = 1)
                        <tr class="text-center">
                            <th>Sr.no</th>
                            @if(Request::is('order/package'))
                            <th>Transaction Id</th>
                            <th>Discount</th>
                            <th>GST</th>
                            <th>Total</th>
                            <th>Package Name</th>
                            <th>Package Time</th>
                            @endif
                            <th>Product</th>
                            <th>Time</th>
                            <th>Customer Details</th>
                            @if(Request::is('order/package'))
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Address</th>
                            <th>Pincode</th>
                            <th>Area</th>
                            <th>Landmark</th>
                            <th>City</th>
                            <th>Order Date</th>
                            @endif
                            <th>Address</th>
                            <th>Delivery Status</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($packageorders as $data )
                        <tr>
                            <td class="align-middle text-center">{{$i++}}</td>
                            @if(Request::is('order/package'))
                            <td class="align-middle text-center">{{$data->id}}</td>
                            <th class="align-middle text-center">{{$data->discountamt}}</th>
                            <th class="align-middle text-center">{{$data->gstamt}}</th>
                            <td class="align-middle text-center">{{$data->grandtotal}}</td>
                            <td class="align-middle text-center">{{$data->trxsubscriptionorder->packageId}}</td>
                            <td class="align-middle text-center">{{$data->trxsubscriptionorder->subscribedfor}}</td>
                            @endif
                            <td class="align-middle text-center">{{$data->productName}}</td>
                            <td class="align-middle text-center">{{$data->mealTime}}</td>
                            <td class="align-middle text-center">
                                {{$data->user->name}} <br> {{$data->user->email}} <br> {{$data->user->phone}}
                            </td>
                            @if(Request::is('order/package'))
                            <td class="align-middle text-center">
                                {{$data->cpname}}
                            </td>
                            <td class="align-middle text-center">{{$data->cpno}}</td>
                            <td class="align-middle text-center">{{$data->address}}</td>
                            <td class="align-middle text-center">{{$data->pincode}}</td>
                            <td class="align-middle text-center">{{$data->area}}</td>
                            <td class="align-middle text-center">{{$data->landmark}}</td>
                            <td class="align-middle text-center">{{$data->city}}</td>
                            <td class="align-middle text-center">{{date('d M, Y', strtotime($data->created_at))}}</td>
                            @endif
                            <td class="align-middle text-center">
                                {{$data->trx->address}} <br>
                                {{$data->trx->pincode}} <br>
                                {{$data->trx->area}} <br>
                                {{$data->trx->landmark}} <br>
                                {{$data->trx->city}} <br>
                            </td>
                            <td class="align-middle text-center">{{$data->status}}
                                <a href="" class="btn btn-icon has-ripple" data-toggle="modal" data-target="#changePackageStatus{{$data->id}}" title="Change Status"><i class="fas fa-edit"></i></a>
                            </td>
                            <!-- <td class="table-action text-center">
                                <div>
                                    <a href="" class="btn btn-icon btn-outline-success has-ripple" data-toggle="modal" data-target="#viewLabelPackageModal{{$data->id}}"><i class="fas fa-file-invoice"></i></a>
                                </div>
                            </td> -->
                        </tr>

                        <!--View Label Modal -->
                        <!-- <div class="modal fade" id="viewLabelPackageModal{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Print Label</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times" style="font-size: 25px; "></i>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="printLabelPackageBody{{$data->id}}">
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
                                                    <p for="">{{$data->trx->cpname}}</p>
                                                </div>
                                                <div class="col-3">
                                                    <h6 for="">Phone </h6>
                                                </div>
                                                <div class="col-9">
                                                    <p for="">{{$data->trx->cpno}}</p>
                                                </div>
                                                <div class="col-3">
                                                    <h6 for="">Address </h6>
                                                </div>
                                                <div class="col-9">
                                                    <p for="">{{$data->trx->address}}, {{$data->trx->area}},{{$data->trx->pincode}} </p>
                                                </div>
                                                <div class="col-3">
                                                    <h6 for="">Landmark </h6>
                                                </div>
                                                <div class="col-9">
                                                    <p for="">{{$data->trx->landmark}} </p>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>

                                                <div class="col-12">
                                                    <h5 for="">Order </h5>
                                                </div>
                                                <div class="col-12">
                                                    <p for="">{{$data->productName}} </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" onclick="printLabelPackage('{{$data->id}}')" class="btn btn-primary">
                                            <i class="fas fa-print" style="font-size: 20px;"></i>Print
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- End View Label modal -->

                        <!--Status Modal -->
                        <div class="modal fade" id="changePackageStatus{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Change Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times" style="font-size: 25px; "></i>
                                        </button>
                                    </div>
                                    <form action="{{url('/order/package/update')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="hiddenId" value="{{$data->id}}">
                                        <div class="modal-body">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label style="font-weight: bold;" for="role">Status <span style="color: red;">&#42</span></label>
                                                    <select class="form-control selectpicker" name="status" id="status">
                                                        <optgroup label="Status">
                                                            <option value="Completed" {{$data->status == 'Completed' ? 'selected' : ''}}>Completed</option>
                                                            <option value="In Kitchen" {{$data->status == 'In Kitchen' ? 'selected' : ''}}>In Kitchen</option>
                                                            <option value="Pending" {{$data->status == 'Pending' ? 'selected' : ''}}>Pending</option>
                                                            <option value="Cancelled" {{$data->status == 'Cancelled' ? 'selected' : ''}}>Cancelled</option>
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
<script src="assets/js/pages/widgets.js"></script>
<script src="//www.amcharts.com/lib/3/amcharts.js"></script>
<script src="assets/js/pages/features/charts/amcharts/charts.js"></script>
<script src="//www.amcharts.com/lib/3/serial.js"></script>
<script src="//www.amcharts.com/lib/3/radar.js"></script>
<script src="//www.amcharts.com/lib/3/pie.js"></script>
<script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js"></script>
<script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js"></script>
<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="//www.amcharts.com/lib/3/themes/light.js"></script>
<script src="assets/js/pages/features/charts/apexcharts.js"></script>
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
    function printLabelPackage(id) {
        var divContents = $('#printLabelPackageBody' + id).html();
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