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
                <h5>Wallet History of {{$wallets->user->name}} </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="tabdata" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr class="text-center">
                            <th>Trx Id</th>
                            <th>Amount</th>
                            <th>Trx Type</th>
                            <th>Remark</th>
                            <th>Date</th>
                            <th>Time</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wallets->walletremarks as $key => $data )
                        <tr>
                            <td class="align-middle text-center">{{$data->trxId}}</td>
                            <td class="align-middle text-center">{{$data->amount}}</td>
                            <td class="align-middle text-center">
                                @if($data->trxType == 'Debit')
                                <span class="badge badge-danger">Debit</span>
                                @elseif($data->trxType == 'Credit')
                                <span class="badge badge-success">Credit</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">{{$data->remark}}</td>
                            <td class="align-middle text-center">{{date('d M, Y', strtotime($data->created_at))}}</td>
                            <td class="align-middle text-center">{{date('h:i a', strtotime($data->created_at))}}</td>
                                                        
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