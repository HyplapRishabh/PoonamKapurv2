@extends('layouts.admin')

@section('title', 'Wallet')

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
<!-- table section -->
<div class="col-sm-12 mt-3">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h5>Wallet</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="tabdata" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr class="text-center">
                            <th>Sr.no</th>
                            <th>User Name</th>
                            <th>Available Balance</th>
                            <th>Locked Amount</th>
                            <th>Total Added</th>
                            <th>Total Spent</th>
                            <th>Wallet History</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wallets as $key => $data )
                        <tr>
                            <td class="align-middle text-center">{{++$key}}</td>
                            <td class="align-middle text-center">
                                @if (isset($data->user))
                                {{$data->user->name}}
                                @else
                                 <span style="color: red;" >User Deleted</span> 
                                @endif
                            </td>
                            <td class="align-middle text-center">{{$data->availableBal}}</td>
                            <td class="align-middle text-center">{{$data->lockedAmt}}</td>
                            <td class="align-middle text-center">{{$data->totalAdded}}</td>
                            <td class="align-middle text-center">{{$data->totalSpent}}</td>
                            <td class="align-middle text-center">
                                <a href="{{url('wallet/walletHistory')}}/{{$data->userId}}" class="btn btn-primary">Wallet History</a>
                            </td>
                            <td class="table-action text-center">
                                <div>
                                    <!-- <a href="" class="btn btn-icon btn-outline-primary has-ripple" data-toggle="modal" data-target="#showModal{{$data->id}}"><i class="far fa-eye"></i><span class="ripple ripple-animate" style="height: 45px; width: 45px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: 7.39999px; left: -12.6px;"></span></a> -->
                                    <a href="" class="btn btn-icon btn-outline-warning has-ripple" data-toggle="modal" data-target="#updateModal{{$data->id}}"><i class="fas fa-pen"></i></a>
                                    <!-- <a href="" class="btn btn-icon btn-outline-danger has-ripple" data-toggle="modal" data-target="#deleteModal{{$data->id}}"><i class="far fa-trash-alt"></i></a> -->
                                </div>
                            </td>
                            <!--Update Modal -->
                            <div class="modal fade" id="updateModal{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Update Wallet</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fas fa-times" style="font-size: 25px; "></i>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="color: black;">
                                            <form action="{{url('/wallet/update')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="hiddenId" value="{{$data->id}}">
                                                <input type="hidden" name="hiddenUserId" value="{{$data->userId}}">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="role">Select Mode <span style="color: red;">&#42</span></label>
                                                            <select class="form-control selectpicker" name="type" id="">
                                                                <optgroup label="Status">
                                                                    <option value="Debit">Debit</option>
                                                                    <option value="Credit">Credit</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="Name">Amount <span style="color: red;">&#42</span></label>
                                                            <input type="number" class="form-control" name="amount" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 modal-footer">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                            Update Wallet
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
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
</div>
@endsection

@section('scripts')

@endsection