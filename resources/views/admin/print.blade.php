@extends('layouts.admin')

@section('title', 'Print Labels')

@section('header')
<style>

</style>

@endsection

@section('content')
<div class="row" style="row-gap: 10px;">
    @if(isset($alacartorders) && count($alacartorders) > 0)
    @foreach ($alacartorders as $data)
    <div class="col-md-4">
        <div class="card" style="border: 2px solid #000; padding: 10px; border-radius: 10px; ">
            <div class="row g-2">
                <div class="col-9">
                    <picture>
                        <img src="/webassets/images/logo.png" class="img-fluid" alt="image desc">
                    </picture>
                </div>
                <div class="col-3" style="display: flex; align-items: center;">
                    {{ date('d M Y', strtotime($data->created_at)) }}
                </div>
                <div class="col-12 mt-2" style="display: flex; align-items: center; justify-content: center;">
                    <h6 for="">Poonam Kapur Healthy Kitchen</h6>
                </div>
                <div class="col-12 mt-2" style="display: flex; align-items: center; justify-content: center;">
                    <h6 style="font-weight: 900;" for="">( ALACART )</h6>
                </div>
                <div class="col-4 mt-5">
                    <h6 for="">Order No </h6>
                </div>
                <div class="col-8 mt-5">
                    <p for="">{{$data->id}}</p>
                </div>
                <div class="col-4">
                    <h6 for="">Name </h6>
                </div>
                <div class="col-8">
                    <p for="">{{$data->cpname}}</p>
                </div>
                <div class="col-4">
                    <h6 for="">Phone </h6>
                </div>
                <div class="col-8">
                    <p for="">{{$data->cpno}}</p>
                </div>
                <div class="col-4">
                    <h6 for="">Address </h6>
                </div>
                <div class="col-8">
                    <p for="">{{$data->address}}, {{$data->area}}, {{$data->pincode}} </p>
                </div>
                <div class="col-4">
                    <h6 for="">Landmark </h6>
                </div>
                <div class="col-8">
                    <p for="">{{$data->landmark}} </p>
                </div>
                <div class="col-12">
                    <hr>
                </div>

                <div class="col-10 text-center">
                    <h5 for="">Order </h5>
                </div>
                <div class="col-2 text-center">
                    <h5 for="">Qty </h5>
                </div>
                @foreach($data->trxalacartorder as $key=>$orderdetails)

                <div class="col-10">
                    <p for="">{{$key+1}}) {{$orderdetails->productName}} </p>
                    @if($orderdetails->addonName != null)
                    <span style="padding-left: 25px;" for=""> [{{$orderdetails->addonName}}] </span>
                    @endif
                </div>
                <div class="col-2 text-center">
                    <p for="">x{{$orderdetails->qty}} </p>
                </div>

                @endforeach


            </div>
        </div>
    </div>
    @endforeach
    @endif
    @if(isset($packageorders) && count($packageorders) > 0)
    @foreach ($packageorders as $data)
    <div class="col-md-4">
        <div class="card" style="height: 100%; border: 2px solid #000; padding: 10px; border-radius: 10px; ">
            <div class="row g-2">
                <div class="col-9">
                    <picture>
                        <img src="/webassets/images/logo.png" class="img-fluid" alt="image desc">
                    </picture>
                </div>
                <div class="col-3" style="display: flex; align-items: center;">
                    {{ date('d M Y', strtotime($data->created_at)) }}
                </div>
                <div class="col-12 mt-2" style="display: flex; align-items: center; justify-content: center;">
                    <h6 for="">Poonam Kapur Healthy Kitchen</h6>
                </div>
                <div class="col-12 mt-2" style="display: flex; align-items: center; justify-content: center;">
                    <h6 style="font-weight: 900;" for="">( SUBSCRIPTION )</h6>
                </div>
                <div class="col-4 mt-5">
                    <h6 for="">Order No </h6>
                </div>
                <div class="col-8 mt-5">
                    <p for="">{{$data->id}}</p>
                </div>
                <div class="col-4">
                    <h6 for="">Name </h6>
                </div>
                <div class="col-8">
                    <p for="">{{$data->trx->cpname}}</p>
                </div>
                <div class="col-4">
                    <h6 for="">Phone </h6>
                </div>
                <div class="col-8">
                    <p for="">{{$data->trx->cpno}}</p>
                </div>
                <div class="col-4">
                    <h6 for="">Address </h6>
                </div>
                <div class="col-8">
                    <p for="">{{$data->trx->address}}, {{$data->trx->area}},{{$data->trx->pincode}} </p>
                </div>
                <div class="col-4">
                    <h6 for="">Landmark </h6>
                </div>
                <div class="col-8">
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
    @endforeach
    @endif
</div>

@endsection

@section('scripts')

@endsection