@extends('layouts.admin')

@section('title', 'Subscription Orders')

@section('header')

@endsection

@section('content')

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))
<div class="col-sm-12">
    <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
        {{ Session::get('alert-' . $msg) }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
@endforeach
<div class="row">
    @if(Session::has('counter'))
    <div class="col-sm-6">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ Session::get('counter') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    @if(Session::has('success'))
    <div class="col-sm-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    <!-- @if(Session::has('repeated'))
    <div class="col-sm-3">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('repeated') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    @if(Session::has('failed'))
    <div class="col-sm-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif -->
    @if ($errors->any())
    <div class="col-sm-12">
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
    </div>
    @endif
</div>

@if(Session::has('failedIds'))
<!-- count number of failedids -->
@php
$failedIds = Session::get('failedIds');
$failedIdsCount = count($failedIds);
@endphp
@if($failedIdsCount > 0)
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed to import {{ $failedIdsCount }} Records.</strong> <br>
            Row :
            @foreach(Session::get('failedIds') as $failedId)
            <!-- Add and if last entry or a comma  -->
            {{ $failedId }}@if(!$loop->last),@endif
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
@endif

@if(Session::has('repeatedIds'))
<!-- count number of repeatedIds -->
@php
$repeatedIds = Session::get('repeatedIds');
$repeatedIdsCount = count($repeatedIds);
@endphp
@if($repeatedIdsCount > 0)
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ $repeatedIdsCount }} Repeated Records Found.</strong> <br>
            Row :
            @foreach(Session::get('repeatedIds') as $repeatedId)
            <!-- Add and if last entry or a comma  -->
            {{ $repeatedId }}@if(!$loop->last),@endif
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
@endif
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
                            <th>Package Name</th>
                            <th>Package Time</th>
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
                            <!-- <th>Delivery Status</th> -->
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
                            @endif
                            <td class="align-middle text-center">{{$data->trxsubscriptionorder->packageId}}</td>
                            <td class="align-middle text-center">{{$data->trxsubscriptionorder->subscribedfor}}</td>
                            <td class="align-middle text-center">
                                {{$data->cpname}} <br> {{$data->cpno}}
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
                            <td class="align-middle ">
                                {{$data->address}} <br>
                                {{$data->pincode}} <br>
                                {{$data->area}} <br>
                                {{$data->landmark}} <br>
                                {{$data->city}} <br>
                            </td>
                            <!-- <td class="align-middle text-center">{{$data->deliverystatus}}
                                <a href="" class="btn btn-icon has-ripple" data-toggle="modal" data-target="#changeStatus{{$data->id}}" title="Cancel Product"><i class="fas fa-edit"></i></a>
                            </td> -->
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