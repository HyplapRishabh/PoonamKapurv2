@extends('layouts.admin')

@section('title', 'Ala Cart Orders')

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

<div class=" col-sm-12 text-right">
    <a href="{{url('/order/alacart')}}" class="btn btn-success btn-lg m-4 has-ripple">
        <i class="fas fa-check"></i>
        Successful Transactions
    </a>
</div>

<!-- table section -->
<div class="col-sm-12 mt-3">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h5>Ala Cart Failed Transactions</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="tabdata" class="table table-striped table-bordered nowrap">
                    <thead>
                        @php($i = 1)
                        <tr class="text-center">
                            <th>Sr.no</th>
                            <th>Transaction Id</th>
                            <th>Payment Id</th>
                            <th>Payment Gateway</th>
                            <th>Wallet</th>
                            <th>Delivery Charges</th>
                            <th>Discount</th>
                            <th>Order Total</th>
                            <th>GST</th>
                            <th>Grand Total</th>
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Address</th>
                            <th>Pincode</th>
                            <th>Area</th>
                            <th>Landmark</th>
                            <th>City</th>
                            <th>Reason</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alacartorders as $data )
                        <tr>
                            <td class="align-middle text-center">{{$i++}}</td>
                            <td class="align-middle text-center">{{$data->id}}</td>
                            <td class="align-middle text-center">{{$data->paymenId}}</td>
                            <td class="align-middle text-center">{{$data->payuamt}}</td>
                            <td class="align-middle text-center">{{$data->walletamt}}</td>
                            <th class="align-middle text-center">{{$data->deliveryamt}}</th>
                            <th class="align-middle text-center">{{$data->discountamt}}</th>
                            <th class="align-middle text-center">{{$data->subtotalamt}}</th>
                            <th class="align-middle text-center">{{$data->gstamt}}</th>
                            <th class="align-middle text-center">{{$data->grandtotal}}</th>
                            <td class="align-middle text-center">{{$data->cpname}}</td>
                            <td class="align-middle text-center">{{$data->cpno}}</td>
                            <td class="align-middle text-center">{{$data->address}}</td>
                            <td class="align-middle text-center">{{$data->pincode}}</td>
                            <td class="align-middle text-center">{{$data->area}}</td>
                            <td class="align-middle text-center">{{$data->landmark}}</td>
                            <td class="align-middle text-center">{{$data->city}}</td>
                            <td class="align-middle text-center">{{$data->reason}}
                            <td class="align-middle text-center">{{$data->errormsg}}
                            <td class="align-middle text-center">{{date('d M, Y h:i a', strtotime($data->created_at))}}
                            
                            <td class="table-action text-center">
                                <div>
                                    <a href="" class="btn btn-outline-warning has-ripple" data-toggle="modal" data-target="#viewModal{{$data->id}}"><i class="fas fa-eye"></i>View Orders</a>
                                    <!-- <a href="" class="btn btn-icon btn-outline-danger has-ripple" data-toggle="modal" data-target="#deleteModal{{$data->id}}"><i class="far fa-trash-alt"></i></a> -->
                                </div>
                            </td>
                        </tr>
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
                                            <div class="col-2 text-center" style="border: 1px solid #000;">Price</div>
                                            <div class="col-2 text-center" style="border: 1px solid #000;">Quantity</div>
                                            <div class="col-3 text-center" style="border: 1px solid #000;">Addon</div>
                                            <div class="col-2 text-center" style="border: 1px solid #000;">Price</div>
                                        </div>
                                        @foreach($data->trxalacartorder as $key=>$orderdetails)
                                        <div class="row">
                                            <div class="col-3 text-center" style="border: 1px solid #000;">{{$orderdetails->productName}}</div>
                                            <div class="col-2 text-center" style="border: 1px solid #000;">{{$orderdetails->productPrice}}</div>
                                            <div class="col-2 text-center" style="border: 1px solid #000;">{{$orderdetails->qty}}</div>
                                            <div class="col-3 text-center" style="border: 1px solid #000;">{{$orderdetails->addonName}}</div>
                                            <div class="col-2 text-center" style="border: 1px solid #000;">{{$orderdetails->addonprice}}</div>
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
                                                            <option value="In Kitchen" {{$data->deliverystatus == 'In Kitchen' ? 'selected' : ''}}>In Kitchen</option>
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

                        <!--Delete Modal -->
                        <div class="modal fade" id="deleteModal{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times" style="font-size: 25px; "></i>
                                        </button>
                                    </div>

                                    <form action="{{url('/faqs/deleteFaqs')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="hiddenId" value="{{$data->id}}">
                                        <div class="modal-body">
                                            <p style="color: black;"> Are you sure you want to delete this Faqs? <br> ACTION CAN NOT BE REVERTED </p>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-trash-alt" style="font-size: 20px;"></i>Delete
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End delete modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')


@endsection