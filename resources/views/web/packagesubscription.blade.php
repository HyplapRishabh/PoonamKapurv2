<!doctype html>
<html lang="en" dir="ltr">

<!-- app/user-add.html   08:53:53 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                                    <form>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="fname">Enter Your Name:</label>
                                                <input type="text" class="form-control" id="fname"
                                                    placeholder="Enter Your Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="mobno">Mobile Number:</label>
                                                <input type="text" class="form-control" id="mobno"
                                                    placeholder="Mobile Number">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="add1">Street Address 1:</label>
                                                <input type="text" class="form-control" id="add1"
                                                    placeholder="Street Address 1">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="add2">Landmark</label>
                                                <input type="text" class="form-control" id="add2"
                                                    placeholder="Enter Nearby Landmark">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="form-label">Select City:</label>
                                                <select name="type" class="selectpicker form-control" data-style="py-0">
                                                    <option>Select City</option>
                                                    <option>Andheri</option>
                                                    <option>Bandra</option>
                                                    <option>Juhu</option>
                                                    <option>Malad</option>
                                                    <option>Borivali</option>
                                                </select>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="pno">Pin Code:</label>
                                                <input type="text" class="form-control" id="pno" placeholder="Pin Code">
                                            </div>

                                        </div>
                                        <hr>

                                        <div class="checkbox">
                                            <label class="form-label"><input class="form-check-input me-2"
                                                    type="checkbox" value="" id="flexCheckChecked">You Agree To Our
                                                Terms & Conditions</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary rounded-pill">Place Order</button>
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
                                            <h6 class="heading-title fw-bolder text-primary">{{$input['type']}}</h6>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="heading-title fw-bolder">Total Amount</h6>
                                            <h6 class="heading-title fw-bolder text-primary">&#8377 {{$finalamt}}</h6>
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

</html>