<!doctype html>
<html lang="en" dir="ltr">

<!--    08:54:35 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poonamkapur.com | Online Diet Food & Many More in Mumbai</title>

    @include('web.weblayout.headlayout')
    <style>
        .bkgcategory
        {

            background-image:url("{{url('webassets/images/layouts/01.png')}}");
            background-repeat: no-repeat; 
            
            background-size: cover;background-position: center right;
        }
        .bodycss
        {
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
            <!-- <div class="d-flex flex-wrap justify-content-between">
                <div class="d-flex align-items-center flex-wrap mb-4 mb-lg-0">
                    <button type="button" class="btn btn-outline-primary me-5 rounded-pill">#INV-0012456</button>
                    <div class="d-flex align-items-end ms-5">
                        <span class="text-dark fw-bolder">Orders /</span>
                        <span class="mb-0 fw-bolder">Orders Details</span>
                    </div>
                </div>
                <div class="d-flex flex-wrap">
                    <button type="button" class="btn btn-outline-danger rounded-pill">Cancel Order</button>
                    <button type="button" class="btn text-white btn-success ms-3 rounded-pill">Delivered</button>
                </div>
            </div> -->
            <div class="row mt-4">
                <div class="col-md-12 col-lg-4 col-xl-3">
                    <div class="card ">
                        <div class="card-body p-0">
                            <div class="p-4 border-bottom">
                                <div class="text-center">
                                    <img src="../assets/images/order-details/1.png"
                                        class="img-fluid avatar-rounded avatar-100" alt="profile-image">
                                    <h6 class="mt-3 heading-title fw-bolder">My Wallet</h6>
                                    <button type="button" class="btn btn-outline-primary mt-3 rounded-pill">Wallet
                                        Balance : {{$userwallet->availableBal}}/-</button>
                                </div>
                                <div class="text-center mt-4">

                                    <form action="{{url('/app/subscriptionorderplace')}}" onsubmit="addfund(event)" method="post" >
                                        @csrf
                                            <input type="hidden" id="txnid" name="txnid" value="{{$txnid}}">
                                            <input type="hidden" id="useremailid" name="useremailid" value="{{Auth::user()->email}}">
                                            <input type="hidden" value="{{$userdetail->name}}" id="fname" name="fname">
                                            <input type="hidden" name="mobilenumber" value="{{$userdetail->phone}}" id="mobno">
                                            <input type="hidden" id="userid" name="userid" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="mobilenumber" value="{{$userdetail->phone}}" id="mobno">
                                            <div class="form-group" >
                                                <label class="form-label" for="number">Add Balance</label>
                                                <input type="number"  min="1" class="form-control" onkeyup="checkminamt()" placeholder="Top-Up your wallet" id="addamt">
                                                <span style="color: red;  display: none;" id="amterror">Amount should be greater than Rs. 100</span>
                                            </div>
                                        <button type="submit"  class="btn btn-primary rounded">Add Balance</button>
                                      
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                
                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">
                    <div class="card table-responsive">
                        <table class="table table-borderless product-table rounded">
                            <thead class="bg-primary ">
                                <tr>
                                    <th><span class="heading-title rowpad text-white">Particular</span></th>
                                    <!-- <th><span class="heading-title rowpad text-white">Product Name</span></th> -->
                                   
                                    <th class="text-center"><span class="heading-title rowpad text-white ">Amount</span></th>

                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wallethistory as $waleltinfo)
                                <tr class="cart_item border-bottom">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../assets/images/order-details/5.png"
                                                class="img-fluid avatar-rounded avatar-70" alt="profile-image">
                                            <div class="d-flex ms-4">
                                                <div>
                                                    <h6 class="heading-title text-primary">{{$waleltinfo->trxType}} for {{$waleltinfo->trxFor}}</h6>
                                                    <p class="mb-0 fw-bolder">{{$waleltinfo->remark}}</p>
                                                    <p class="mb-0 fw-bolder">{{$waleltinfo->created_at->format('d-m-Y H:i a')}}</p>
                                                </div>
                                       
                                                </div>
                                            </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="rowpad">Rs {{$waleltinfo->amount}}</span>
                                    </td>
                                </tr>
                                @endforeach
                           
                            </tbody>
                        </table>
                    </div>
                   
                
                </div>
            </div>

        </div>
        @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')

    <script>

        function checkminamt()
        {
            if(document.getElementById('addamt').value>99)
            {
                document.getElementById('amterror').style.display='none';
                
            }   
            else
            {
                document.getElementById('amterror').style.display='block';
            }
        }

        function addfund(event)
        {
            event.preventDefault();
            if(document.getElementById('addamt').value>99)
            {
                var data = new FormData();
                data.append('key', 'gtKFFx');
                data.append('txnid', document.getElementById('txnid').value);
                data.append('amount', document.getElementById('addamt').value);
                data.append('udf1',document.getElementById('addamt').value);
                data.append('udf5', document.getElementById('userid').value);
                data.append('firstname', document.getElementById('fname').value);
                data.append('email', document.getElementById('useremailid').value);
                data.append('productinfo', 'walletRecharge');

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/app/gethashofpayu', true);
                xhr.onload = function () {
                    console.log(this.responseText);
                    xhrval = JSON.parse(xhr['response']);
                    runfinalbolt(xhrval['encryptpass']);
                };
                xhr.send(data);
            }
            
        }

        function runfinalbolt(hash) {
            console.log(hash);
            boltdata = {
                //key:'YI0Weq', 
                key: 'gtKFFx',
                txnid: document.getElementById('txnid').value,
                hash: hash,
                amount: document.getElementById('addamt').value,
                //amount: 1,
                firstname: document.getElementById('fname').value,
                email: document.getElementById('useremailid').value,
                phone: document.getElementById('mobno').value,
                productinfo: 'walletRecharge',
                udf1: document.getElementById('addamt').value,
                udf5: document.getElementById('userid').value,

                surl: 'http://localhost:8000/app/payuwalletresponsepkhk',
                furl: 'http://localhost:8000/app/payuwalletresponsepkhk',
            };
            console.log(boltdata);
            var fr = '<form action=\"https://test.payu.in/_payment" method=\"post\">' +
                '<input type=\"hidden\" name=\"key\" value=\"' + boltdata.key + '\" />' +
                '<input type=\"hidden\" name=\"txnid\" value=\"' + boltdata.txnid + '\" />' +
                '<input type=\"hidden\" name=\"amount\" value=\"' + boltdata.amount + '\" />' +
                '<input type=\"hidden\" name=\"productinfo\" value=\"' + boltdata.productinfo + '\" />' +
                '<input type=\"hidden\" name=\"firstname\" value=\"' + boltdata.firstname + '\" />' +
                '<input type=\"hidden\" name=\"email\" value=\"' + boltdata.email + '\" />' +
                '<input type=\"hidden\" name=\"udf1\" value=\"' + boltdata.udf1 + '\" />' +
                '<input type=\"hidden\" name=\"udf5\" value=\"' + boltdata.udf5 + '\" />' +
                '<input type=\"hidden\" name=\"surl\" value=\"http://localhost:8000/app/payuwalletresponsepkhk\" />' +
                '<input type=\"hidden\" name=\"furl\" value=\"http://localhost:8000/app/payuwalletresponsepkhk\" />' +
                '<input type=\"hidden\" name=\"phone\" value=\"' + boltdata.phone + '\" />' +
                '<input type=\"hidden\" name=\"hash\" value=\"' + boltdata.hash + '\" />' +
                '</form>';
            console.log('HI' + fr);
            var form = jQuery(fr);
            jQuery('body').append(form);
            form.submit();
        }
    </script>
</body>
</html>