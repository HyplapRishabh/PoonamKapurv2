<!doctype html>
<html lang="en" dir="ltr">

<!-- app/user-add.html   08:53:53 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
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
                                    <form action="#" method="post" >
                                        @csrf
                                        <input type="hidden" value="45453" name="paymentId">
                                        <input type="hidden" id="ssubtotalval" name="subtotalval">
                                        <input type="hidden" id="staxval" name="taxval">
                                        <input type="hidden" id="sfinaltotalval" name="finaltotalval">
                                        <input type="hidden" id="sdeliveryval" name="deliveryval">
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
                                                <select name="pincode" required id="pincodeval" class="js-example-basic-single selectpicker form-control " onChange="pincodechg()" data-style="py-0">
                                                    <option value="" selected>Select Pincode</option>
                                                    @foreach($pincodelist as $pinlist)
                                                        <option value="{{$pinlist->pincode}}">{{$pinlist->pincode}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Select Area:</label>
                                                <select name="area" required class="js-example-basic-single selectpicker form-control " id="areanameval" data-style="py-0">
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="checkbox">
                                            <label class="form-label"><input class="form-check-input me-2"
                                                    type="checkbox" value="" required id="flexCheckChecked">You Agree To Our
                                                Terms & Conditions</label>
                                        </div>
                                        <button type="submit" onclick="launchBOLT()" class="btn btn-primary rounded-pill">Place Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                    <div class="card my-cart-card">
                        <div
                            class="card-header d-flex align-items-center justify-content-between pb-0  border-bottom-0">
                            <h4 class="list-main">My Cart</h4>
                           
                        </div>
                        <div class="card-body" style="height:350px; overflow-y:auto">
                            @foreach($cartlist as $cartinfo)
                            <div class="rounded-pill bg-soft-primary iq-my-cart">
                                <div class="d-flex align-items-center justify-content-between profile-img4">
                                    <div class="profile-img11">
                                        <img src="{{asset($cartinfo->product->image)}}"
                                        onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                        alt="{{$cartinfo->product->name}}"
                                            class="img-fluid rounded-pill avatar-115 blur-shadow position-end">
                                        <img src="{{asset($cartinfo->product->image)}}"
                                        onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                        alt="{{$cartinfo->product->name}}"
                                            class="img-fluid rounded-pill avatar-115" >
                                    </div>
                                    <div class="d-flex align-items-center profile-content">
                                        <div>
                                            <h6 class="mb-1 heading-title fw-bolder">{{$cartinfo->product->name}}</h6>
                                            @if($cartinfo['addoncart'])
                                            <small class="mb-0">{{$cartinfo['addoncart']['addon']['description']}} ({{$cartinfo['addoncart']['addon']['quantity']}} {{$cartinfo['addoncart']['addon']['unit']}})</small>
                                            @endif
                                            <h6 class="mb-1 heading-title fw-bolder">Qty : {{$cartinfo->qty}}</h6>
                                        </div>
                                    </div>
                                    <div class="me-4 text-end">
                                        @if($cartinfo['addoncart'])
                                            <p class="mb-0 text-dark" style="white-space: nowrap; margin-top: 25px;">&#8377 {{$cartinfo->product->discountedPrice*$cartinfo->qty + $cartinfo['addoncart']['addon']['price']*$cartinfo->qty}}</p>
                                        @else
                                            <p class="mb-0 text-dark" style="white-space: nowrap; margin-top: 25px;">&#8377 {{$cartinfo->product->discountedPrice*$cartinfo->qty}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="my-cart-body" id="disptotal" >
                             <div class="border border-primary rounded p-3 mt-5">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="heading-title fw-bolder">Total</h6>
                                        <h6 class="heading-title fw-bolder text-primary" id="totalval"></h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="heading-title fw-bolder">Tax</h6>
                                        <h6 class="heading-title fw-bolder text-primary" id="taxval"></h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center ">
                                        <h6 class="heading-title fw-bolder">Delivery charges</h6>
                                        <h6 class="heading-title fw-bolder text-primary" id="deliverychg">&#8377</h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center ">
                                        <h6 class="heading-title fw-bolder">Final Total</h6>
                                        <h6 class="heading-title fw-bolder text-primary" id="finaltotalval">&#8377</h6>
                                    </div>
                                </div>
                                <!-- <div class="text-center mt-3">
                                    <a href="{{url('/app/alacartcheckout')}}" class="btn btn-primary rounded-pill">Checkout</a>
                                </div> -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var deliverychg=30;
        $(document).ready(function () {
            deliverychg=30;
            calculate();
            
            $('.js-example-basic-single').select2();
        });

        function pincodechg()
        {
            newpincodeval=document.getElementById('pincodeval').value;
            $.ajax({
                url: '/app/pincodechg/'+newpincodeval,
                type: "get",
                success: function (data) {

                    console.log(data);
                    if (data['status'] == "success") {
                        str = "";
                        data['pincodelist'].forEach(element => {
                            str+='<option value="'+element['areaName']+'">'+element['areaName']+'</option>';
                        }); 
                        
                        document.getElementById('deliverychg').innerHTML=data['pincodelist'][0]['deliveryCharge'];
                        document.getElementById('areanameval').innerHTML=str;
                        deliverychg=data['pincodelist'][0]['deliveryCharge'];
                        console.log(deliverychg);
                        calculate();
                    }
                    else {

                    }
                }
            });
        }
         function calculate() {
            $.ajax({
                url: '/app/getcartdata',
                type: "get",
                success: function (data) {

                    console.log(data);
                    if (data['status'] == "success") {
                        str = "";
                        if (data['cartlist'][0]) 
                        {
                            document.getElementById('disptotal').style.display='block'; 
                            cartlist=data['cartlist'];
                            total=0;
                            gst=0;
                            finaltotal=0;

                            cartlist.forEach(element => {
                                if(element['addoncart'])
                                {
                                    total=total+(element['product']['discountedPrice']*element['qty'])+(element['addoncart']['addon']['price']*element['qty']);
                                }
                                else
                                {
                                    total=total+element['product']['discountedPrice']*element['qty'];
                                }
                            });

                            finaltotal=deliverychg*1+gst*1+total*1;
                            document.getElementById('totalval').innerHTML='&#8377 '+total;
                            document.getElementById('taxval').innerHTML='&#8377 '+gst;
                            document.getElementById('finaltotalval').innerHTML='&#8377 '+finaltotal;
                            document.getElementById('deliverychg').innerHTML='&#8377 '+deliverychg;
                            
                            document.getElementById('ssubtotalval').value=total;
                            document.getElementById('staxval').value=gst;
                            document.getElementById('sfinaltotalval').value=finaltotal;
                            document.getElementById('sdeliveryval').value=deliverychg;

                        }
                        else {
                            document.getElementById('disptotal').style.display='none'; 
                            document.getElementById('cartdata2').innerHTML = '<div class="text-center mt-3"><button type="button" class="btn btn-primary rounded-pill">You Dont Have Any Product In Your Cart</button></div>';
                        }

                    }
                    else {

                    }
                }
            });
        }
    </script>
                    <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script> 

  
                <script type="text/javascript">
                function launchBOLT(){
                   
                    $salt='MBFfc0sn';

                   bolt.launch({
                        key: 'YI0Weq',
                        txnid: 'dem2321', 
                        hash: '03854d3e9c0415e10d6f18686724f80e4dc76d05dd9245d3fcff3e3f846b26f1ced1a27dae85baff0402fa9aeccf16fb65181b19510dfafab14ab40f7064af0b',
                        amount: '10',
                        firstname: 'RIshabh',
                        email: 'rishabh.2745@gmail.com',
                        phone: '8779508036',
                        productinfo: 'alacart',
                        udf5: '',
                        surl : '/poonam',
                        furl: '/poonamerror',
                        mode: 'dropout' 
                    },{ responseHandler: function(BOLT){
                        console.log( BOLT);     
                        if(BOLT.response.txnStatus != 'CANCEL'){
                            //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
                            var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
                            '<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
                            '<input type=\"hidden\" name=\"salt\" value=\"'+$salt+'\" />' +
                            '<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
                            '<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
                            '<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
                            '<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
                            '<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
                            '<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
                            '<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
                            '<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
                            '<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
                            '</form>';
                            var form = jQuery(fr);
                            jQuery('body').append(form);                                
                            form.submit();
                        }
                    },
                    catchException: function(BOLT){
                        console.log( BOLT );
                    }
                });

                    
                }
    </script>
      
</body>

</html>