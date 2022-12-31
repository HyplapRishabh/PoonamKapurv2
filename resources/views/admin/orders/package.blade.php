@extends('layouts.admin')

@section('title', 'Subscription Orders')

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
@if(Request::is('order/package'))
<div class=" col-sm-12 text-right">
    <a href="{{url('/order/package/failed')}}" class="btn btn-danger btn-lg m-4 has-ripple">
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
                <h5>Subscription</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="tabdata" class="table table-striped table-bordered nowrap">
                    <thead>
                        @php($i = 1)
                        <tr class="text-center">
                            <th>Sr.no</th>
                            @if(Request::is('order/package'))
                            <th>Transaction Id</th>
                            <th>Discount</th>
                            <th>GST</th>
                            <th>Total</th>
                            @endif
                            <th>Product Name</th>
                            <th>Product Time</th>
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
                            <td class="align-middle text-center">{{$data->finalamt}}</td>
                            @endif
                            <td class="align-middle text-center">{{$data->productName}}</td>
                            <td class="align-middle text-center">{{$data->mealTime}}</td>
                            @if(isset($data->trx))
                            <td class="align-middle text-center">{{$data->trx->cpname}} <br> {{$data->trx->cpno}}</td>
                            @endif
                            @if(Request::is('order/package'))
                                @if(isset($data->trx))
                                <td class="align-middle text-center">{{$data->trx->address}}</td>
                                @endif
                                @if(isset($data->trx))
                                <td class="align-middle text-center">{{$data->trx->pincode}}</td>
                                @endif
                                @if(isset($data->trx))
                                <td class="align-middle text-center">{{$data->trx->area}}</td>
                                @endif
                                @if(isset($data->trx))
                                <td class="align-middle text-center">{{$data->trx->landmark}}</td>
                                @endif
                                @if(isset($data->trx))
                                <td class="align-middle text-center">{{$data->trx->city}}</td>
                                @endif
                            <td class="align-middle text-center"></td>
                            @endif
                            <td class="align-middle ">
                                @if(isset($data->trx))
                                {{$data->trx->address}} <br>
                                @endif
                                @if(isset($data->trx))
                                {{$data->trx->pincode}} <br>
                                @endif
                                @if(isset($data->trx))
                                {{$data->trx->area}} <br>
                                @endif
                                @if(isset($data->trx))
                                {{$data->trx->landmark}} <br>
                                @endif
                                @if(isset($data->trx))
                                {{$data->trx->city}} <br>
                                @endif
                            </td>
                            <td class="align-middle text-center">{{$data->status}}
                                <a href="" class="btn btn-icon has-ripple" data-toggle="modal" data-target="#changeStatus{{$data->id}}" title="Cancel Product"><i class="fas fa-edit"></i></a>
                            </td>
                            <!-- <td class="table-action text-center"> -->
                                <!-- <div> -->
                                    <!-- <a href="" class="btn btn-icon btn-outline-warning has-ripple" data-toggle="modal" data-target="#viewModal{{$data->id}}"><i class="fas fa-eye"></i></a> -->
                                    <!-- <a href="" class="btn btn-icon btn-outline-danger has-ripple" data-toggle="modal" data-target="#deleteModal{{$data->id}}"><i class="far fa-trash-alt"></i></a> -->
                                <!-- </div> -->
                            <!-- </td> -->
                        </tr>
                        

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

<script>

</script>

@endsection