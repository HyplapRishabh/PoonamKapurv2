@extends('layouts.admin')

@section('title', 'Raw Material')

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

<!-- Filter Start -->
<div class="col-sm-12 mt-3">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h5>Search for Raw Material</h5>
            </div>
        </div>
        <form action="{{url('/inventory')}}" method="get">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label style="font-weight: bold;" for="Name">Select Product </label>
                            <select class="form-control selectpicker" name="product" id="product">
                                <optgroup label="Product">
                                    <option value="All">All</option>
                                    @foreach($rawmaterials as $rawmaterial)
                                    <option value="{{$rawmaterial->UID}}">{{$rawmaterial->name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label style="font-weight: bold;" for="Name"> Date <span style="color: red;">&#42</span></label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer modal-footer">
                <button type="submit" class="btn btn-primary mr-2">Search</button>
            </div>
        </form>
    </div>
</div>

<!-- table section -->
<div class="col-sm-12 mt-3">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h5>Inventory History</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="tabdata" class="table table-striped table-bordered nowrap">
                    <thead>
                        @php($i = 1)
                        <tr class="text-center">
                            <th>Sr.no</th>
                            <th>Item</th>
                            <th>Item Used for</th>
                            <th>Order Type</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Action</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $data )
                        <tr>
                            <td class="align-middle text-center">{{$i++}}</td>
                            <td class="align-middle text-center">
                                @if(isset($data->rawmaterial))
                                <span>{{$data->rawmaterial->name}}</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                @if(isset($data->product))
                                <span>{{$data->product->name}}</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">{{$data->orderType}}</td>
                            <td class="align-middle text-center">{{$data->quantity}}</td>
                            <td class="align-middle text-center">
                            @if(isset($data->rawmaterial))
                                <span>{{$data->rawmaterial->unit}}</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">{{$data->action}}</td>
                            <td class="align-middle text-center">{{date('d M, Y', strtotime($data->created_at))}}</td>
                            
                        </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection