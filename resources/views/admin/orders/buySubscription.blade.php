@extends('layouts.admin')

@section('title')
Add Report
@endsection

@section('header')

@endsection

@section('content')
<form action="{{url('/buySubscription/add')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 style="color: black;">Buy Subscription For User</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label style="font-weight: bold;" for="role">Select User <span style="color: red;">&#42</span></label>
                                            <label id="walletLabel" style="display: none;">Wallet Bal : ₹<span id="walletBal"></span> </label>
                                        </div>
                                        <select class="form-control selectpicker" onchange="userChanged()" data-size="6" data-live-search="true" required name="userId" id="userId">
                                            <option value="" selected>Select User</option>
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: bold;" for="pincode"> Pincode <span style="color: red;">&#42</span></label>
                                        <select class="form-control selectpicker" onchange="pincodeChanged()" data-size="6" data-live-search="true" id="pincode" name="pincode" required>
                                            <option value="" selected>Select Pincode</option>
                                            @foreach ($pincodes as $pincode)
                                            <option value="{{ $pincode->pincode }}">{{ $pincode->pincode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: bold;" for="area"> Select Area <span style="color: red;">&#42</span></label>
                                        <select class="form-control selectpicker" onchange="areaChanged()" disabled data-size="4" data-live-search="true" id="area" name="area" required>
                                            <option value="" selected>Select Pincode First</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: bold;" for="address"> Address <span style="color: red;">&#42</span></label>
                                        <input type="text" class="form-control" onchange="addressChanged()" id="address" name="address" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: bold;" for="landmark"> Landmark <span style="color: red;">&#42</span></label>
                                        <input type="text" class="form-control" onchange="landmarkChanged()" id="landmark" name="landmark" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 style="color: black;">Select Package</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: bold;" for="goal"> Select Goal <span style="color: red;">&#42</span></label>
                                        <select class="form-control selectpicker" onchange="goalChanged()" id="goal" name="goal" required>
                                            <option value="" selected>Select Goal</option>
                                            @foreach ($goals as $goal)
                                            <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: bold;" for="package"> Select Package <span style="color: red;">&#42</span></label>
                                        <select class="form-control selectpicker" onchange="packageChanged()" disabled data-size="4" data-live-search="true" id="package" name="package" required>
                                            <option value="" selected>Select Goal First</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: bold;" for="area"> Subscribe For <span style="color: red;">&#42</span></label>
                                        <select class="form-control selectpicker" onchange="mealTimeChanged()" multiple name="mealTime[]" id="mealTime" required>
                                            @foreach($mealTimes as $mealTime)
                                            <option value="{{$mealTime->name}}">{{$mealTime->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: bold;" for="days"> Select Days <span style="color: red;">&#42</span></label>
                                        <select class="form-control selectpicker" onchange="dayChanged()" id="days" name="days" required>
                                            <option value="" selected>Select Days</option>
                                            <option value="3">3 Days</option>
                                            <option value="15">15 Days</option>
                                            <option value="30">30 Days</option>
                                            <option value="60">60 Days</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    $mindate = date('Y-m-d', strtotime("+1 day"));
                                    ?>
                                    <div class="form-group">
                                        <label style="font-weight: bold;" for=""> Start Date <span style="color: red;">&#42</span></label>
                                        <input type="date" min="{{$mindate}}" class="form-control " onchange="startDateChanged()" id="startDate" name="startDate" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer modal-footer">
                            <div class=" text-right">
                                <button type="submit" class="btn btn-primary">Confirm Subscription</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="card w-100">
                    <div class="card-header">
                        <h5 style="color: black;">Payment Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="paymentId"> Payment Id</label>
                                <input type="text" class="form-control" id="paymentId" name="paymentId">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="mode"> Select Payment Mode <span style="color: red;">&#42</span></label>
                                <select class="form-control selectpicker" disabled data-size="4" data-live-search="true" id="mode" name="mode" required>
                                    <option value="OFFLINE">OFFLINE</option>
                                    <option value="WALLET">WALLET</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="card w-100">
                    <div class="card-header">
                        <h5 style="color: black;">Order Summary</h5>
                        <!-- <button type="button" onclick="calculateTotal()">click for total</button> -->
                    </div>
                    <div class="card-body">
                        <span id="nameSelected"></span>
                        <span id="pincodeSelected"></span>
                        <span id="areaSelected"></span>
                        <span id="addressSelected"></span>
                        <span id="landmarkSelected"></span>
                        <br>
                        <span id="goalSelected"></span>
                        <span id="packageSelected"></span>
                        <span id="mealTimeSelected"></span>
                        <span id="daySelected"></span>
                        <span id="modeSelected"></span>
                        <span id="startDateSelected"></span>
                        <br>
                        <span id="packageTotal"></span>
                        <input type="hidden" name="packageTotal" id="packageTotalVal">
                        <span id="deliveryTotal"></span>
                        <input type="hidden" name="deliveryTotal" id="deliveryTotalVal">
                        <span id="grandTotal"></span>
                        <input type="hidden" name="grandTotal" id="grandTotalVal">
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection
@section('scripts')
<script>
    function userChanged() {
        console.log('user changed');
        var userId = $('#userId').val();

        $.ajax({
            type: "post",
            url: "{{url('/getUserWalletBalance')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "userId": userId
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $('#walletLabel').css('display', 'block');
                $('#walletBal').html(response.wallet.availableBal);
                typeEffect('You are subcribing for <strong>' + response.wallet.user.name + '</strong>', '#nameSelected');

                if ($('#goal').val() != '') {
                    typeEffect('<strong>' + $('#userId option:selected').text() + '</strong> is aiming for <strong>' + $('#goal option:selected').text() + '</strong> diet ', '#goalSelected');
                }
            }
        });
    }

    function pincodeChanged() {
        console.log('pincode changed');
        var pincode = $('#pincode').val();
        $('#area').empty();

        $.ajax({
            type: "post",
            url: "{{url('/getAreasByPincode')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "pincode": pincode
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $('#area').attr('disabled', false);
                $('#area').append($('<option>', {
                    value: '',
                    text: 'Select Area'
                }));
                $(response.areas).each(function(i, item) {
                    $('#area').append($('<option>', {
                        value: item.id,
                        text: item.areaName
                    }));
                });


                $('#area').selectpicker('refresh');
                typeEffect('whose pincode is <strong>' + pincode + '</strong>', '#pincodeSelected');

            }
        });
    }

    function areaChanged() {
        // get the area name
        var areaName = $('#area option:selected').text();

        typeEffect('in <strong>' + areaName + '</strong> area', '#areaSelected');
    }

    function addressChanged() {
        var address = $('#address').val();
        typeEffect(', residing at <strong>' + address + '</strong>', '#addressSelected');
    }

    function landmarkChanged() {
        var landmark = $('#landmark').val();
        typeEffect(' near <strong>' + landmark + '</strong>.', '#landmarkSelected');
    }

    function goalChanged() {
        var goalName = $('#goal option:selected').text();
        var goalId = $('#goal').val();

        $.ajax({
            type: "post",
            url: "{{url('/getPackagesByGoal')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "goalId": goalId
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $('#package').empty();
                $('#package').attr('disabled', false);
                $('#package').append($('<option>', {
                    value: '',
                    text: 'Select Package'
                }));
                $(response.packages).each(function(i, item) {
                    $('#package').append($('<option>', {
                        value: item.UID,
                        text: item.UID
                    }));
                });

                $('#package').selectpicker('refresh');

                typeEffect('<strong>' + $('#userId option:selected').text() + '</strong> is aiming for <strong>' + $('#goal option:selected').text() + '</strong> diet ', '#goalSelected');
            }
        });

    }

    function packageChanged() {
        var packageName = $('#package option:selected').text();
        typeEffect(' and is subscribing <strong>' + packageName + '</strong> package ', '#packageSelected');
    }

    function mealTimeChanged() {
        var mealTimeName = $('#mealTime option:selected').text();

        var mealTimeId = $('#mealTime').val();
        typeEffect(' for <strong>' + mealTimeId + '</strong>', '#mealTimeSelected');
    }

    function dayChanged() {
        var dayName = $('#days option:selected').text();
        typeEffect(' which will continue for <strong>' + dayName + '</strong>', '#daySelected');
    }

    function startDateChanged() {
        var startDate = $('#startDate').val();
        typeEffect(' starting from <strong>' + startDate + '</strong>. <br> <a href="javascript:void()" onclick=calculateTotal() > Calculate Total </a> ', '#startDateSelected');
    }

    function calculateTotal() {
        var packageUID = $('#package').val();
        var mealTimeUID = $('#mealTime').val();
        var day = $('#days').val();
        var areaId = $('#area').val();

        $.ajax({
            type: "post",
            url: "{{url('/getPackageTotal')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "packageUID": packageUID,
                "mealTimeUID": mealTimeUID,
                "day": day,
                "areaId": areaId
            },
            dataType: "json",
            success: function(response) {

                console.log(response);
                $('#packageTotalVal').val(response.packageTotal);
                $('#deliveryTotalVal').val(response.deliveryCharge);
                $('#grandTotalVal').val(response.grandTotal);

                typeEffect(' <div class=" d-flex justify-content-between">\
                                <label style="font-weight: bold;"> Package Total</label>\
                                <label > ' + response.packageTotal + ' </label>\
                            </div> ', '#packageTotal');
                typeEffect(' <div class=" d-flex justify-content-between">\
                                <label style="font-weight: bold;"> Delivery Total</label>\
                                <label > ' + response.deliveryCharge + ' </label>\
                            </div> ', '#deliveryTotal');
                typeEffect(' <div class=" d-flex justify-content-between">\
                                <label style="font-weight: bold;"> Grand Total</label>\
                                <label > ' + response.grandTotal + ' </label>\
                            </div> ', '#grandTotal');

            }
        });
    }

    function typeEffect(text, location) {
        var typeString = [text];
        var i = 0;
        var count = 0;
        var selectedText = "";
        var text = "";

        function type() {
            selectedText = typeString[count];
            text = selectedText.slice(0, ++i);
            $(location).html(text);
            if (text.length === selectedText.length) {
                count++;
                i = 0;
            }

            // Replace setTimeout with requestAnimationFrame
            if (count == typeString.length) {
                return;
            } else {
                requestAnimationFrame(type);
            }
        }

        // Start the animation
        requestAnimationFrame(type);
    }
</script>

<script>

</script>
@endsection