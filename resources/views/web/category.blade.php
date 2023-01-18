<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poonamkapur.com | {{$categorydtl->name}}</title>

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

<body class="bodycss" onload="loadonpagedata()">
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
            <div class="card " data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6"
                data-iq-delay=".8" data-iq-trigger="scroll" data-iq-ease="none">
                <div class="hero-image p-3 bkgcategory">
                    <div class="card-body p-5">
                        <div class="row banner-container">
                            <div class="col-lg-12 banner-item">

                                <div class="banner-text pt-3">
                                    <h1 class="fw-bold mb-4 text-center">{{$categorydtl->name}} </h1>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-3">
                    <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                        data-iq-duration=".6" data-iq-delay=".7" data-iq-trigger="scroll" data-iq-ease="none">
                        <div class="card-header">
                            <div class="header-title">
                                <h4 class="card-title">Our Meals</h4>
                            </div>
                        </div>
                        <div class="card-body py-0" id='catdiv'>
                            <ul class="list-inline list-main iq-special-product">
                                @foreach($mealTypes as $mealinfo)
                                <li onclick="changemealtype('{{$mealinfo->webmealtype->name}}')"
                                    class="py-3 d-flex align-items-center btn {{ $input['mealtype']==$mealinfo->webmealtype->name ? 'btnheighlight' : '' }}">
                                    <!-- <img src="../assets/images/restaurant/04.png" class="img-fluid rounded-circle avatar-45" alt="profile-image"> -->
                                    <div class="ms-3">
                                        <h5 class="heading-title fw-bolder">{{$mealinfo->webmealtype->name}}</h5>
                                        <p class="mb-0">{{$mealinfo->totalmealTypeId}}+ options</p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-transparent mb-5">
                        <div class="card-body">
                            <div class="col-xl-12 col-lg-12 dish-card-horizontal mt-2">
                                <div class="row  row-cols-md-3 row-cols-xl-3 row-cols-xxl-3" id="productdtl">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                        data-iq-duration=".6" data-iq-delay="1" data-iq-trigger="scroll" data-iq-ease="none">
                        <div class="card-header">
                            <h4 class="card-title">My Cart
                                <a style="float:right" href="{{url('/app/viewcart')}}" class="card-title"><svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.016 7.38948V6.45648C15.016 4.42148 13.366 2.77148 11.331 2.77148H6.45597C4.42197 2.77148 2.77197 4.42148 2.77197 6.45648V17.5865C2.77197 19.6215 4.42197 21.2715 6.45597 21.2715H11.341C13.37 21.2715 15.016 19.6265 15.016 17.5975V16.6545" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M21.8096 12.0215H9.76855" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M18.8813 9.1062L21.8093 12.0212L18.8813 14.9372" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </svg></a>
                            </h4>
                            
                        </div>
                        <div class="card-body" id="cartdata">

                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Footer Section Start -->
        @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')
    <script>

        function loadonpagedata() {
            loadcart();
            loadnewprod();
        }
        function changemealtype(mealtype) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('mealtype', mealtype);
            let stateObj = { id: "100" };
            window.history.replaceState(stateObj, "Page 3", "?" + urlParams);

            loadnewprod();
        }

        function loadnewprod() {
            winsearch = window.location.search;
            $.ajax({
                url: '/app/getproductfilter/rh' + winsearch,
                type: "get",
                success: function (data) {
                    document.getElementById('productdtl').innerHTML = '<div class="bkgloader"><div class="loader123"></div>';

                    if (data['status'] == "success") {
                        str = "";
                        data['productdtl'].forEach(element => {
                            str += '<div class="col-md-4 col-sm-4 col-xl-4 active fade-in-card">\
                                        <div class="card card-white dish-card profile-img mb-0">\
                                            <div class="profile-img21"><a style="all:unset" href="/app/dish/'+element['slug']+'">\
                                                <img src="/'+ element['image'] + '" onerror="src=`/webassets/images/greyimage.jpg`" class="fade-in-card img-fluid rounded-pill avatar-170 blur-shadow position-bottom" alt="' + element['name'] + '">\
                                                <img src="/'+ element['image'] + '" onerror="src=`/webassets/images/greyimage.jpg`" class="fade-in-card img-fluid rounded-pill avatar-170 hover-image " alt="' + element['name'] + '" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">\
                                            </a></div>\
                                            <div class="card-body menu-image">\
                                                <h6 class="heading-title fw-bolder mt-4 mb-0 twoLiner" style="height: 40px"><a style="all:unset" href="/app/dish/'+element['slug']+'">'+ element['name'] + '</a></h6>\
                                                <div class="d-flex justify-content-between mt-3">\
                                                    <div class="d-flex align-items-center">\
                                                        <span class="text-primary fw-bolder me-2">&#8377 '+ element['discountedPrice'] + '</span>\
                                                        <small class="text-decoration-line-through">&#837 '+ element['price'] + '</small>\
                                                    </div>\
                                                </div>\
                                                <div>\
                                                    <a  onclick="displayaddon(`0`,`'+ element['id'] + '`,`' + element['mealTypeId'] + '`)" class="btn btn-outline-primary rounded-pill w-100 mt-2">Add</a>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>'
                        });
                        document.getElementById('productdtl').innerHTML = str;
                    }
                    else {

                    }
                }
            });

              $( "#catdiv" ).load(window.location.href + " #catdiv" );
        }

        function loadcart() {
            $.ajax({
                url: '/app/getcartdata',
                type: "get",
                success: function (data) {

                    console.log(data);
                    if (data['status'] == "success") {
                        str = "";
                        if (data['cartlist'][0]) {
                            data['cartlist'].forEach(element => {
                                if(element['addoncart'])
                                {
                                    str += '<div class="d-flex justify-content-between align-items-center mb-5">\
                                        <div class="d-flex align-items-center">\
                                            <img alt="' + element['product']['name'] + '" src="/'+ element['product']['image'] + '" onerror="src=`/webassets/images/greyimage.jpg`" class="img-fluid rounded-pill  avatar-50" alt="2">\
                                            <div class="ms-3">\
                                                <h6 class="heading-title fw-bolder mb-2">'+element['product']['name']+'</h6>\
                                                <small style="color:#EA6A12;" class="mb-0"><a onclick="displayaddon('+element['id']+','+element['product']['id']+','+element['product']['mealTypeId']+')">Customize> </a>'+element['addoncart']['addon']['description']+' ('+element['addoncart']['addon']['quantity']+' '+element['addoncart']['addon']['unit']+')</small>\
                                            </div>\
                                        </div>\
                                        <h6 class="heading-title">₹'+(element['product']['discountedPrice']*1+element['addoncart']['addon']['price']*1) + '</h6>\
                                    </div>'
                                }
                                else
                                {
                                    str += '<div class="d-flex justify-content-between align-items-center mb-5">\
                                    <div class="d-flex align-items-center">\
                                        <img alt="' + element['product']['name'] + '" src="/'+ element['product']['image'] + '" onerror="src=`/webassets/images/greyimage.jpg`" class="img-fluid rounded-pill  avatar-50" alt="2">\
                                        <div class="ms-3">\
                                            <h6 class="heading-title fw-bolder mb-2">'+element['product']['name']+'</h6>\
                                            <small style="color:#EA6A12;" class="mb-0"><a onclick="displayaddon('+element['id']+','+element['product']['id']+','+element['product']['mealTypeId']+')">Customize></a></small>\
                                            <p class="mb-0"></p>\
                                        </div>\
                                    </div>\
                                    <h6 class="heading-title">₹'+(element['product']['discountedPrice']) + '</h6>\
                                </div>'
                                }
                                
                            });
                            document.getElementById('cartdata').innerHTML = str;
                        }
                        else {
                            document.getElementById('cartdata').innerHTML = '<div class="text-center mt-3"><button type="button" class="btn btn-primary rounded-pill">You Dont Have Any Product In Your Cart</button></div>';
                        }

                    }
                    else {

                    }
                }
            });
        }
       
    </script>
</body>



</html>