<!doctype html>
<html lang="en" dir="ltr">

<!-- app/user-add.html   08:53:53 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Poonamkapur.com | Online Diet Food & Many More in Mumbai</title>

    @include('web.weblayout.headlayout')
    <style>
        .bkgcategory {

            background-image:url("{{url('webassets/images/layouts/01.png')}}");
            background-repeat: no-repeat;

            background-size: cover;
            background-position: center right;
        }

        .bodycss {
            background-image:url("{{url('webassets/images/dashboard.png')}}");
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>

<body class="bodycss">
    @include('web.weblayout.loader')
    <div class="position-relative">
        <div class="user-img1">
            <svg width="1857" viewBox="0 0 1857 327" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M4.05078 189.348C86.8841 109.514 348.951 -25.2523 734.551 74.3477C1120.15 173.948 1641.22 91.181 1853.55 37.3477"
                    stroke="#EA6A12" stroke-opacity="0.3" />
                <path
                    d="M0.99839 152.331C90.9502 80.6133 364.495 -28.9952 739.062 106.31C1113.63 241.616 1640.16 208.056 1856.6 174.363"
                    stroke="#EA6A12" stroke-opacity="0.3" />
            </svg>
        </div>
    </div>

    <main class="main-content">
        <div class="position-relative">
        @include('web.weblayout.headerlayout')
        </div>
        <div class="content-inner mt-5 py-0">
            <div>
                <div class="row">

                    <div class="col-xl-8 col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Enter Your Details</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                <form action="{{url('/app/subscriptionorderplace')}}" onsubmit="subscriptionpayment(event)" method="post" >
                                        @csrf
                                        <input type="hidden" value="45453" name="paymentId">
                                        <input type="hidden" id="ssubtotalval" name="subtotalval" value="{{$finalamt}}">
                                        <input type="hidden" id="staxval" name="taxval" value="0">
                                        <input type="hidden" id="sfinaltotalval" name="finaltotalval" value="{{$finalamt}}">
                                        <input type="hidden" id="sgrandtotalval" name="sgrandtotalval" value="{{$finalamt}}">
                                        <input type="hidden" id="sdeliveryval" name="deliveryval" value="0">
                                        <input type="hidden" id="walletuseflag" name="walletuseflag" value="0">
                                        <input type="hidden" id="goalid" name="goalid" value="{{$packageinfo->goal->id}}">
                                        <input type="hidden" id="packageid" name="packageid" value="{{$packageinfo->UID}}">
                                        <input type="hidden" id="days" name="days" value="{{$input['days']}}">
                                        <input type="hidden" id="ps" name="ps" value="{{$input['ps']}}">
                                        <input type="hidden" id="totalmeals" name="totalmeals" value="{{$input['days']*$mealtimecount}}">
                                        <input type="hidden" id="subscribefor" name="subscribefor" value="{{$input['type']}}">
                                        <input type="hidden" id="useremailid" name="useremailid" value="{{Auth::user()->email}}">
                                        <input type="hidden" id="userid" name="userid" value="{{Auth::user()->id}}">
                                        <input type="hidden" id="txnid" name="txnid" value="{{$txnid}}">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="fname">Enter Your Name:</label>
                                                <input type="text" required class="form-control" value="{{$userdetail->name}}" name="username" id="fname" placeholder="Enter Your Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="mobno">Mobile Number:</label>
                                                <input type="text" required class="form-control" name="mobilenumber" value="{{$userdetail->phone}}" id="mobno"
                                                    placeholder="Mobile Number">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="add1">Street Address 1:</label>
                                                <input type="text" required class="form-control" name="addressdtl" id="add1"
                                                    placeholder="Street Address 1">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="add2">Landmark</label>
                                                <input type="text" required class="form-control" name="landmark" id="add2"
                                                    placeholder="Enter Nearby Landmark">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="pno">Pin Code:</label>
                                                <select name="pincode" required id="pincodeval" class="selectpicker form-control" onChange="pincodechg()" data-style="py-0">
                                                    <option value="" selected>Select Pincode</option>
                                                    @foreach($pincodelist as $pinlist)
                                                        <option value="{{$pinlist->pincode}}">{{$pinlist->pincode}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Select Area:</label>
                                                <select name="area" required onChange="cityselected()"
                                                    class="js-example-basic-single selectpicker form-control "
                                                    id="areanameval" data-style="py-0">
                                                    <option value="" selected >Select Area</option>
                                                </select>
                                                <span id='areaalert' style="color: red;display: none;">The selected area is not available for delivery at this time</span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="add2">Subscription Start Date</label>
                                                <input type="date" min="{{$mindate}}" required class="form-control" name="startdate" id="startdate1"
                                                    placeholder="Select subscription start date">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="checkbox">
                                            <label class="form-label"><input class="form-check-input me-2"
                                                    type="checkbox" value="" required id="flexCheckChecked">You Agree To Our
                                                Terms & Conditions</label>
                                        </div>
                                        <button type="submit" id='placeorderbtn' class="btn btn-primary rounded-pill">Place Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                            data-iq-duration=".6" data-iq-delay="1.2" data-iq-trigger="scroll" data-iq-ease="none">
                            <div class="card-header">
                                <h4 class="list-main">Subscription</h4>
                            </div>
                            <div class="card-body">
                                
                                <div class="my-cart-body">
                                    <div class="border border-primary rounded p-3 mt-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="heading-title fw-bolder">Goal</h6>
                                            <h6 class="heading-title fw-bolder text-primary">{{$packageinfo->goal->name}}</h6>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="heading-title fw-bolder">Package</h6>
                                            <h6 class="heading-title fw-bolder text-primary">{{$packageinfo->name}}</h6>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="heading-title fw-bolder">Days</h6>
                                            <h6 class="heading-title fw-bolder text-primary">{{$input['days']}} Days</h6>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="heading-title fw-bolder">Total Meals</h6>
                                            <h6 class="heading-title fw-bolder text-primary">{{$input['days']*$mealtimecount}} Meals</h6>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="heading-title fw-bolder">Subscribe for</h6>
                                            <h6 class="heading-title fw-bolder text-primary" id='subscribeforval'>{{$input['type']}}</h6>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="heading-title fw-bolder">Total Amount</h6>
                                            <h6 class="heading-title fw-bolder text-primary">&#8377 {{$finalamt}}</h6>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="heading-title fw-bolder">
                                                <input type="checkbox" checked id="walluse" name="walletcheckbox" onchange="calculate()" value="{{$userwallet['availableBal']}}">
                                                Wallet Balance
                                            </h6>
                                            <h6 class="heading-title fw-bolder text-primary">&#8377 {{$userwallet['availableBal']}}</h6>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="heading-title fw-bolder">Payable</h6>
                                            <h6 class="heading-title fw-bolder text-primary" id='afterwallet'>&#8377 {{$finalamt}}</h6>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')
</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524"  bolt-logo="https://poonamkapur.com/assets/images/logo_dark.png"></script>

<script>
        $(document).ready(function () {
            $('#pincodeval').select2();
            $('#areanameval').select2();
            calculate();
        });

        function pincodechg() {
            newpincodeval = document.getElementById('pincodeval').value;
            $.ajax({
                url: '/app/pincodechg/' + newpincodeval,
                type: "get",
                success: function (data) {
                    document.getElementById('areaalert').style.display='none';
                    console.log(data);
                    if (data['status'] == "success") {
                        str='';
                        str += '<option value="" selected >Select Area</option>';
                        data['pincodelist'].forEach(element => {
                            str += '<option value="' + element['areaName'] + '">' + element['areaName'] + '</option>';
                        });
                        console.log(str);
                        document.getElementById('areanameval').innerHTML = str;
                    }
                    else {

                    }
                }
            });
        }
        function cityselected()
        {
            newcityval = document.getElementById('areanameval').value;
            $.ajax({
                url: '/app/cityvalchg/' + newcityval,
                type: "get",
                success: function (data) {

                    console.log(data);
                    if (data['status'] == "success") {

                        // document.getElementById('deliverychg').innerHTML = data['citylist']['deliveryCharge'];
                        // deliverychg = data['citylist']['deliveryCharge'];
                        // console.log(deliverychg);
                        // calculate();

                        var subscribeforval=document.getElementById('subscribeforval').innerHTML;
                        subscribeforval=subscribeforval.split(',');
                        breakfastf=1;
                        lunchf=1;
                        snacksf=1;
                        dinnerf=1;
                        subscribeforval.forEach(element => {
                            if(element=='BreakFast')
                            {
                                breakfastf=data['citylist']['breakFastFlag'];
                            }
                            if(element=='Lunch')
                            {
                                lunchf=data['citylist']['lunchFlag'];
                            }
                            if(element=='Snack')
                            {
                                snacksf=data['citylist']['snackFlag'];
                            }
                            if(element=='Dinner')
                            {
                                dinnerf=data['citylist']['dinnerFlag'];
                            }
                        });
                        console.log(breakfastf);
                        console.log(lunchf);
                        console.log(snacksf);
                        console.log(dinnerf);
                        if(breakfastf==1 && lunchf==1 && snacksf==1 && dinnerf==1)
                        {
                            console.log('hidf');
                            document.getElementById('areaalert').style.display='none';
                            document.getElementById('placeorderbtn').disabled=false;
                            
                        }
                        else
                        {
                            console.log('hidf1');
                            document.getElementById('areaalert').style.display='block';
                            document.getElementById('placeorderbtn').disabled=true;
                        }
                    }
                    else {

                    }
                }
            });
        }

        function calculate()
        {
            walletbal=$('#walluse').val();
            currenttotal=document.getElementById('sgrandtotalval').value;
            if ($('#walluse').is(":checked"))
            {
                if(walletbal>=currenttotal)
                {
                    walletbal=currenttotal;
                }
                document.getElementById('afterwallet').innerHTML='₹ '+(currenttotal*1-walletbal*1);
                document.getElementById('sfinaltotalval').value=currenttotal-walletbal;
                document.getElementById('walletuseflag').value='1';
            }
            else
            {
                document.getElementById('afterwallet').innerHTML='₹ '+currenttotal;
                document.getElementById('sfinaltotalval').value=currenttotal;
                document.getElementById('walletuseflag').value='0';
            }
            console.log(currenttotal);
            console.log(walletbal);
            console.log(document.getElementById('afterwallet').innerHTML);
        }

      

        
        function subscriptionpayment(event) {
            event.preventDefault();
            trxamtval=document.getElementById('ssubtotalval').value+','+document.getElementById('staxval').value+','+document.getElementById('sfinaltotalval').value+','+document.getElementById('ps').value+','+document.getElementById('walletuseflag').value+','+document.getElementById('sgrandtotalval').value;
            pkgval=document.getElementById('packageid').value+','+document.getElementById('days').value+','+document.getElementById('totalmeals').value;
            var data = new FormData();
            data.append('key', 'YI0Weq');
            data.append('txnid', document.getElementById('txnid').value);
            data.append('amount', document.getElementById('sfinaltotalval').value);
            data.append('udf1',trxamtval);
            data.append('udf2', pkgval);
            data.append('udf3', document.getElementById('subscribefor').value);
            data.append('udf4', document.getElementById('startdate1').value);
            data.append('udf5', document.getElementById('userid').value);


            data.append('firstname', document.getElementById('fname').value);
            data.append('email', document.getElementById('useremailid').value);
            data.append('productinfo', 'subscription');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/app/gethashofpayu', true);
            xhr.onload = function () {
                console.log(this.responseText);
                xhrval = JSON.parse(xhr['response']);
                runfinalbolt(xhrval['encryptpass']);
            };
            xhr.send(data);
        }

        function runfinalbolt(hash) {
            console.log(hash);
            trxamtval=document.getElementById('ssubtotalval').value+','+document.getElementById('staxval').value+','+document.getElementById('sfinaltotalval').value+','+document.getElementById('ps').value+','+document.getElementById('walletuseflag').value+','+document.getElementById('sgrandtotalval').value;
            pkgval=document.getElementById('packageid').value+','+document.getElementById('days').value+','+document.getElementById('totalmeals').value;
           
            boltdata = {
                key:'YI0Weq', 
                //key: 'gtKFFx',
                txnid: document.getElementById('txnid').value,
                hash: hash,
                amount: document.getElementById('sfinaltotalval').value,
                //amount: 1,
                firstname: document.getElementById('fname').value,
                email: document.getElementById('useremailid').value,
                phone: document.getElementById('mobno').value,
                productinfo: 'subscription',
                udf1: trxamtval,
                udf2: pkgval,
                udf3: document.getElementById('subscribefor').value,
                udf4: document.getElementById('startdate1').value,
                udf5: document.getElementById('userid').value,
                address1: document.getElementById('add1').value,
                address2: document.getElementById('add2').value,
                zipcode: document.getElementById('pincodeval').value,
                city: document.getElementById('areanameval').value,

                surl: 'http://poonamkapur.com/app/payuresponsepkhk',
                furl: 'http://poonamkapur.com/app/payuresponsepkhk',
            };
            console.log(boltdata);
            if(boltdata.amount==0)
            {
                var fr = '<form action=\"/app/paywallet" method=\"post\">' +
                '<input type=\"hidden\" name=\"key\" value=\"' + boltdata.key + '\" />' +
                '<input type=\"hidden\" name=\"txnid\" value=\"' + boltdata.txnid + '\" />' +
                '<input type=\"hidden\" name=\"amount\" value=\"' + boltdata.amount + '\" />' +
                '<input type=\"hidden\" name=\"productinfo\" value=\"' + boltdata.productinfo + '\" />' +
                '<input type=\"hidden\" name=\"firstname\" value=\"' + boltdata.firstname + '\" />' +
                '<input type=\"hidden\" name=\"email\" value=\"' + boltdata.email + '\" />' +
                '<input type=\"hidden\" name=\"udf1\" value=\"' + boltdata.udf1 + '\" />' +
                '<input type=\"hidden\" name=\"udf2\" value=\"' + boltdata.udf2 + '\" />' +
                '<input type=\"hidden\" name=\"udf3\" value=\"' + boltdata.udf3 + '\" />' +
                '<input type=\"hidden\" name=\"udf4\" value=\"' + boltdata.udf4 + '\" />' +
                '<input type=\"hidden\" name=\"udf5\" value=\"' + boltdata.udf5 + '\" />' +
                '<input type=\"hidden\" name=\"address1\" value=\"' + boltdata.address1 + '\" />' +
                '<input type=\"hidden\" name=\"address2\" value=\"' + boltdata.address2 + '\" />' +
                '<input type=\"hidden\" name=\"zipcode\" value=\"' + boltdata.zipcode + '\" />' +
                '<input type=\"hidden\" name=\"city\" value=\"' + boltdata.city + '\" />' +
                '<input type=\"hidden\" name=\"surl\" value=\"http://poonamkapur.com/app/payuresponsepkhk\" />' +
                '<input type=\"hidden\" name=\"furl\" value=\"http://poonamkapur.com/app/payuresponsepkhk\" />' +
                '<input type=\"hidden\" name=\"phone\" value=\"' + boltdata.phone + '\" />' +
                '<input type=\"hidden\" name=\"hash\" value=\"' + boltdata.hash + '\" />' +
                '</form>';
                console.log('HI' + fr);
                var form = jQuery(fr);
                jQuery('body').append(form);
                form.submit();
            }
            else
            {
                var fr = '<form action=\"https://secure.payu.in/_payment" method=\"post\">' +
                '<input type=\"hidden\" name=\"key\" value=\"' + boltdata.key + '\" />' +
                '<input type=\"hidden\" name=\"txnid\" value=\"' + boltdata.txnid + '\" />' +
                '<input type=\"hidden\" name=\"amount\" value=\"' + boltdata.amount + '\" />' +
                '<input type=\"hidden\" name=\"productinfo\" value=\"' + boltdata.productinfo + '\" />' +
                '<input type=\"hidden\" name=\"firstname\" value=\"' + boltdata.firstname + '\" />' +
                '<input type=\"hidden\" name=\"email\" value=\"' + boltdata.email + '\" />' +
                '<input type=\"hidden\" name=\"udf1\" value=\"' + boltdata.udf1 + '\" />' +
                '<input type=\"hidden\" name=\"udf2\" value=\"' + boltdata.udf2 + '\" />' +
                '<input type=\"hidden\" name=\"udf3\" value=\"' + boltdata.udf3 + '\" />' +
                '<input type=\"hidden\" name=\"udf4\" value=\"' + boltdata.udf4 + '\" />' +
                '<input type=\"hidden\" name=\"udf5\" value=\"' + boltdata.udf5 + '\" />' +
                '<input type=\"hidden\" name=\"address1\" value=\"' + boltdata.address1 + '\" />' +
                '<input type=\"hidden\" name=\"address2\" value=\"' + boltdata.address2 + '\" />' +
                '<input type=\"hidden\" name=\"zipcode\" value=\"' + boltdata.zipcode + '\" />' +
                '<input type=\"hidden\" name=\"city\" value=\"' + boltdata.city + '\" />' +
                '<input type=\"hidden\" name=\"surl\" value=\"http://poonamkapur.com/app/payuresponsepkhk\" />' +
                '<input type=\"hidden\" name=\"furl\" value=\"http://poonamkapur.com/app/payuresponsepkhk\" />' +
                '<input type=\"hidden\" name=\"phone\" value=\"' + boltdata.phone + '\" />' +
                '<input type=\"hidden\" name=\"hash\" value=\"' + boltdata.hash + '\" />' +
                '</form>';
                console.log('HI' + fr);
                var form = jQuery(fr);
                jQuery('body').append(form);
                form.submit();
            }

        }
    
</script>

</html>