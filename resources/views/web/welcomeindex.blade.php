<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poonamkapur.com | Online Diet Food & Many More in Mumbai</title>

    @include('web.weblayout.headlayout')
</head>

<body style="background:url(webassets/images/dashboard.png);background-attachment: fixed; background-size: cover;">
    @include('web.weblayout.loader')
    <!-- <div class="position-relative">
        <div class="user-img1">
            <svg width="1857" viewBox="0 0 1857 327" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.05078 189.348C86.8841 109.514 348.951 -25.2523 734.551 74.3477C1120.15 173.948 1641.22 91.181 1853.55 37.3477" stroke="#EA6A12" stroke-opacity="0.3" />
                <path d="M0.99839 152.331C90.9502 80.6133 364.495 -28.9952 739.062 106.31C1113.63 241.616 1640.16 208.056 1856.6 174.363" stroke="#EA6A12" stroke-opacity="0.3" />
            </svg>
        </div>
    </div> -->


    <main class="main-content">
        @include('web.weblayout.headerlayout')
        <div class="content-inner mt-5 py-0">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="bd-example">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($banners as $key=>$bannerinfo)
                                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$key}}" class="active"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($banners as $key=>$bannerinfo)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img src="{{asset($bannerinfo->image)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="Banner" class="d-block w-100" alt="#">

                                    <div class="carousel-caption d-none d-md-block">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <button style="margin: 5%;padding:5%;width:100%;" type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#gridSystemModal">
                                                    Customized Meal
                                                </button>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <a href="{{url('/app/alacart')}}" type="button" class="btn  btn-primary rounded-pill" style="margin: 5%;padding:5%;width:100%;">Ala-Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <!-- quiz modal here -->
                    <div id="gridSystemModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="card-title" id="gridModalLabel">Let's calculate BMI & BMR</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <form id="form-wizard1" class="text-center mt-3">
                                            <ul id="top-tab-list" class="p-0 row list-inline">
                                                <li class="col-lg-4 col-md-6 text-start mb-2 active" id="account">
                                                    <a href="javascript:void();" style="text-align: center;">
                                                        <div class="iq-icon">
                                                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                        <p style="font-size: 14px;">Information</p>
                                                    </a>
                                                </li>
                                                <!-- <li id="personal" class="col-lg-3 col-md-6 mb-2 text-start">
                                                    <a href="javascript:void();" style="text-align: center;">
                                                        <div class="iq-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="20"
                                                                width="20" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                            </svg>
                                                        </div>
                                                        <p style="font-size: 14px;">Goal</p>
                                                    </a>
                                                </li> -->
                                                <li id="payment" class="col-lg-4 col-md-6 mb-2 text-start">
                                                    <a href="javascript:void();" style="text-align: center;">
                                                        <div class="iq-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                        </div>
                                                        <p style="font-size: 14px;">Biography</p>
                                                    </a>
                                                </li>
                                                <li id="confirm" class="col-lg-4 col-md-6 mb-2 text-start">
                                                    <a href="javascript:void();" style="text-align: center;">
                                                        <div class="iq-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </div>
                                                        <p style="font-size: 14px;">Finish</p>
                                                    </a>
                                                </li>

                                            </ul>
                                            <!-- fieldsets -->
                                            <fieldset>
                                                <div class="form-card text-start">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Full name: *</label>
                                                                <input type="text" class="form-control" id="quname" name="uname" value="{{Auth::user() != null ? Auth::user()->name : ''}}" placeholder="UserName" />
                                                                <span id='qunameerror' class="errorshow"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Email: *</label>
                                                                <input type="email" class="form-control" id="quemailids" name="email" placeholder="Email Id" />
                                                                <span id='quemailerror' class="errorshow"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Mobile: *</label>
                                                                <input type="text" value="{{Auth::user() != null ? Auth::user()->phone : ''}}" pattern="[6789][0-9]{9}" class="form-control" id="qumobile" name="mobile" placeholder="Phone number" />
                                                                <span id='quemobileerror' class="errorshow"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" name="next" onclick="submitquiz('personal')" class="btn btn-primary text-center rounded">Next</button>
                                                <button type="button" name="next" id="personalbtn" style="display: none;" class="btn btn-primary next action-button text-center rounded" value="Next">Next</button>
                                            </fieldset>

                                            <!-- <fieldset>
                                                <div class="form-card text-start mb-4">
                                                    <div class="row">
                                                        <div class="iq-col-masonry m-0">
                                                            @foreach($goallist as $goalinfo)
                                                            <a onclick="goalselect('{{$goalinfo->id}}')"
                                                                type="button btn rounded-pill"
                                                                class="btn btn-outline-primary rounded iq-col-masonry-block">{{$goalinfo->name}}</a>
                                                            @endforeach
                                                            <input type="hidden" name="goalId" value="" id="goalselect">
                                                            <br>
                                                        </div>
                                                        <span id='qgoalerror' class="errorshow"></span>
                                                    </div>

                                                </div>
                                                <button type="button" name="previous"
                                                    class="btn btn-dark previous action-button-previous  me-3 rounded"
                                                    value="Previous">Previous</button>
                                                <button type="button" name="next" onclick="submitquiz('goal')"
                                                    class="btn btn-primary text-center rounded">Next</button>
                                                <button type="button" name="next" id="goalbtn" style="display: none;"
                                                    class="btn btn-primary next action-button text-center rounded"
                                                    value="Next">Next</button>

                                            </fieldset> -->
                                            <fieldset>
                                                <div class="form-card text-start">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Height: *</label>
                                                                <input type="number" id="qheight" class="form-control" name="qheight" placeholder="Enter Your Height in CM" />
                                                                <span id='qheighterror' class="errorshow"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Weight: *</label>
                                                                <input type="number" id="qweight" class="form-control" name="qweight" placeholder="Enter Your Weight in KG" />
                                                                <span id='qweighterror' class="errorshow"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Age: *</label>
                                                                <input type="text" id="qage" class="form-control" name="qage" placeholder="Enter Your Age" />
                                                                <span id='qageerror' class="errorshow"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Gender: *</label>
                                                                <select class="form-control" name="gender" id="qgender">
                                                                    <option value="">Select gender</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                                <span id='qgendererror' class="errorshow"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" name="previous" class="btn btn-dark previous action-button-previous me-3 rounded" value="Previous">Previous</button>
                                                <button type="button" name="next" onclick="submitquiz('heightweight')" class="btn btn-primary text-center rounded">Next</button>
                                                <button type="button" name="next" id="heightweightbtn" style="display: none;" class="btn btn-primary next action-button text-center rounded" value="Next">Next</button>

                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">

                                                    <h2 class="text-success text-center"><strong>SUCCESS !</strong></h2>
                                                    <br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-3"></div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <p class=" text-center">Your BMI is <span id="BMIShow"></span> & Your BMR is <span id="BMRShow"></span> </p>
                                                            <h4 id='less19' class="purple-text text-center">We recommend
                                                                you
                                                                <a name="dsfg" class="" href="/app/goal/indian-balanced-meal?goal=3&pkgId=13&meal=Veg">Balanced
                                                                    meal </a>package
                                                            </h4>
                                                            <h4 id='more25' class="purple-text text-center">We recommend
                                                                you
                                                                <a name="dsfg" class="" href="/app/goal/weight-loss?goal=1&pkgId=1&meal=Veg">Weight
                                                                    loss </a>package
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" name="previous" class="btn btn-dark previous action-button-previous  me-3 rounded" value="Previous">Previous</button>
                                                <button type="button" name="next" onclick="submitquiz('final')" class="btn btn-primary next action-button rounded" value="Submit">Explore Our Packages</button>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- quiz modal ends here -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card-header border-0  ">
                        <div class="card-transparent bg-transparent mb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>How It Works</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card" style="text-align: center;">
                        <img src="webassets/images/icons_login.png" style="width: 100px; margin: auto;text-align: center;" class="card-img-top" alt="#">
                        <div class="card-body">
                            <h4 class="card-title">Login</h4>
                            <p class="card-text">Simple one step login to the ordering platform </p>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card" style="text-align: center;">
                        <img src="webassets/images/bmi.png" style="width: 100px; margin: auto;text-align: center;" class="card-img-top" alt="#">
                        <div class="card-body">
                            <h4 class="card-title">BMI & BMR Calculations</h4>
                            <p class="card-text">Get your BMI & BMR calculations at your fingertips </p>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card" style="text-align: center;">
                        <img src="webassets/images/icons_goal.png" style="width: 100px; margin: auto;text-align: center;" class="card-img-top" alt="#">
                        <div class="card-body">
                            <h4 class="card-title">Goal Selection</h4>
                            <p class="card-text">Select your body goal as per the requirement & recommendation.
                            </p>
                            <!-- <ul class="list-group list-group-flush">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul> -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card" style="text-align: center;">
                        <img src="webassets/images/icons_meal.png" style="width: 100px; margin: auto;text-align: center;" class="card-img-top" alt="#">
                        <div class="card-body">
                            <h4 class="card-title">Choose Meal Packages</h4>
                            <p class="card-text">Select your meal packages as per your preference.</p>
                        </div>
                        <!-- <ul class="list-group list-group-flush">
                            <li class="list-group-item">Cras justo odio</li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 my-2 col-md-6" >
                    <a href="{{url('/app/alacart')}}" >
                        <!-- <div style="background-image: url('webassets/images/alacartCard.png'); background-repeat: no-repeat; height: 400px; border-radius: 15px; background-size: contain; background-position: center right"></div> -->
                        <img src="webassets/images/alacartCard.png" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="Banner" class="d-block w-100" alt="#" style="border-radius: 20px;">

                    </a>
                </div>
                <div class="col-sm-12 my-2 col-md-6" >
                    <a href="" data-bs-toggle="modal" data-bs-target="#gridSystemModal" >
                        <!-- <div style="background-image: url('webassets/images/customizedMealsCard.png'); background-repeat: no-repeat; height: 400px; border-radius: 15px; background-size: contain; background-position: center right"></div> -->
                        <img src="webassets/images/customizedMealsCard.png" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="Banner" class="d-block w-100" alt="#" style="border-radius: 20px;">
                    </a>
                </div>
            </div>

            <!--  starts-->
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card-header border-0">
                        <div class="card-transparent bg-transparent mb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>Why Choose Us</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- starts -->
                <div class="col-lg-4">
                    <div class="card-profile-progress">
                        <div class="circle-progress circle-progress-basic circle-progress-primary" data-min-value="0"></div>
                        <img src="webassets/images/hm/hygiene.png" class="img-fluid rounded-circle card-img" alt="image" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between">
                                    <div class="fs-italic">
                                        <h5>Hygiene</h5>
                                    </div>

                                    <div class="mt-3 text-center text-black-50">
                                        <p>
                                            We maintain High standards of hygiene and regular kitchen
                                            inspections.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-profile-progress">
                        <div class="circle-progress circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                        <img src="webassets/images/hm/box.png" class="img-fluid rounded-circle card-img" alt="image" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between">
                                    <div class="fs-italic">
                                        <h5>Food Packaging</h5>
                                    </div>

                                    <div class="mt-3 text-center text-black-50">
                                        <p>
                                            Use of food grade Disposables for packaging to keep you more
                                            healthy.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-profile-progress">
                        <div class="circle-progress circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                        <img src="webassets/images/hm/kitchen.png" class="img-fluid rounded-circle card-img" alt="image" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between">
                                    <div class="fs-italic">
                                        <h5>Separate Kitchens</h5>
                                    </div>

                                    <div class="mt-3 text-center text-black-50">
                                        <p>
                                            We keep two sections separate for vegetarian and non vegetarian
                                            food.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-profile-progress">
                        <div class="circle-progress circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                        <img src="webassets/images/hm/diet.png" class="img-fluid rounded-circle card-img" alt="image" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between">
                                    <div class="fs-italic">
                                        <h5>Diet Goals</h5>
                                    </div>

                                    <div class="mt-3 text-center text-black-50">
                                        <p>
                                        Meal combos are curated to suit different dietary requirements.

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-profile-progress">
                        <div class="circle-progress circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                        <img src="webassets/images/hm/macros.png" class="img-fluid rounded-circle card-img" alt="image" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between">
                                    <div class="fs-italic">
                                        <h5>Macro Details</h5>
                                    </div>

                                    <div class="mt-3 text-center text-black-50">
                                        <p>All macros are displayed to help you understand your food.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-profile-progress">
                        <div class="circle-progress circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                        <img src="webassets/images/hm/non-toxic.png" class="img-fluid rounded-circle card-img" alt="image" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between">
                                    <div class="fs-italic">
                                        <h5>No Chemicals</h5>
                                    </div>

                                    <div class="mt-3 text-center text-black-50">
                                        <p>
                                        No added colours, Preservatives or other chemical food additives.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-profile-progress">
                        <div class="circle-progress circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                        <img src="webassets/images/hm/bread.png" class="img-fluid rounded-circle card-img" alt="image" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between">
                                    <div class="fs-italic">
                                        <h5>Protien Breads</h5>
                                    </div>

                                    <div class="mt-3 text-center text-black-50">
                                        <p>Breads used are zero maida, High protein breads.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-profile-progress">
                        <div class="circle-progress circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                        <img src="webassets/images/hm/nutrition.png" class="img-fluid rounded-circle card-img" alt="image" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between">
                                    <div class="fs-italic">
                                        <h5>Better Suggestions</h5>
                                    </div>
                                    <div class="mt-3 text-center text-black-50">
                                        <p>We bridge the gap between nutritionist and vendor.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ends -->
            </div>
            <!-- ends -->

            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="bd-example">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="{{url('/app/consultation')}}">
                                        <img src="webassets/images/BOOKDIETTITIAN.png" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="Banner" class="d-block w-100" alt="#">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-transparent bg-transparent mb-0">
                <div class="card-header border-0  ">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>We Have Served</h3>
                        <!-- <div class="text-dark d-flex"><a href="{{url('/app/alltestimonial')}}">View All</a>
                                <svg width="24" height="24" class="ms-1" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="24" height="24" rx="12" fill="#EA6A12" />
                                    <path d="M10.25 8.5L13.75 12L10.25 15.5" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div> -->
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="swiper-container d-slider2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client1.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client2.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client3.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client4.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client5.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client6.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client7.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client8.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client9.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client10.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client11.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client12.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/clients logo_client13.png" class="img-fluid  avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="card-body p-0">
                    <div class="swiper-container d-slider2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client1.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client2.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client3.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client4.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client5.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client6.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client7.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client8.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client9.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <div class="text-center iq-menu-category">
                                            <img src="webassets/images/hm/client10.png" class="img-fluid rounded-pill avatar-100 mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="card-header border-0  ">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Client Reviews</h3>
                        <div class="text-dark d-flex"><a href="{{url('/app/alltestimonial')}}">View All</a>
                                <svg width="24" height="24" class="ms-1" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="24" height="24" rx="12" fill="#EA6A12" />
                                    <path d="M10.25 8.5L13.75 12L10.25 15.5" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                    </div>
                </div> -->
                <!-- <div class="card-body p-0">
                    <div class="swiper-container d-slider4">
                        <div class="swiper-wrapper">
                            @foreach($testimonials as $testimonialInfo)
                            <div class="swiper-slide">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="{{asset($testimonialInfo->media)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$testimonialInfo->name}}" class="img-fluid rounded-circle avatar-100 mb-2"><br>
                                            <p class="heading-title fw-bolder text-dark ms-3 ms-lg-0">{{$testimonialInfo->name}}</p>
                                        </div>
                                        <div class="col-12 ps-lg-0">
                                            <p style="text-align:justify">{{$testimonialInfo->comment}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="card-transparent bg-transparent mb-0 d-none d-md-block">
                <div class="card-header border-0  ">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Client Reviews</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <div class="bd-example">
                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($testimonials as $key=>$testimonialInfo)
                                <li data-bs-target="#carouselExample" data-bs-slide-to="{{$key}}" class="active"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($testimonials as $key=>$testimonialInfo)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img src="webassets/images/testimonialbanner.jpg" class="d-block w-100" alt="#">
                                    <div class="carousel-caption" style="bottom: 10rem; display: flex; flex-direction: column; justify-content: center; align-items: center; width: 50%;">
                                        <!-- <img src="{{asset($testimonialInfo->media)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$testimonialInfo->name}}" class="img-fluid rounded-circle avatar-100 mb-2"><br> -->
                                        <div class="img-fluid rounded-circle avatar-100 mb-2" style="background-image: url('webassets/images/customizedMealsCard.png'); background-position: center; background-size: contain; background-repeat: no-repeat;" ></div>
                                        <p class="heading-title fw-bolder text-dark ms-3 ms-lg-0">{{$testimonialInfo->name}}</p>
                                        <p style="text-align:justify; overflow-y: scroll; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 4;" >{{$testimonialInfo->comment}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Base buttons -->
        <div class="row " id="enqRow">
            <div class="col-sm-6 text-center">
                <div class="login-block" id="enqBtnfooter">
                    <a href="{{url('/app/alacart')}}" class=" show" style="color: #ff6633;">Ala Cart</a>
                </div>
            </div>
            <div class="col-sm-6 text-center">
                <div class="login-block" id="regBtnfooter">
                    <a data-bs-toggle="modal" data-bs-target="#gridSystemModal" style="color: #fff;">Customized Meal</a>
                </div>
            </div>
        </div>
        <style>
            #regBtnfooter {
                border-radius: 5px;
                width: 100%;
                text-align: center;
                /* padding: 0.5rem 1rem; */
                margin: 0.5rem;
                font-size: 14px;
                /* border: 1px solid #fff; */
                font-weight: 600;
                background-color: #ff6633;
            }


            #enqBtnfooter {
                color: #ff6633;
                width: 100%;
                text-align: center;
                border-radius: 5px;
                /* padding: 0.5rem 1rem; */
                margin: 0.5rem;
                border: 1px solid #ff6633;
                font-size: 14px;
            }

            /* hide row above 1024 px */

            #enqRow {
                background-color: #fff;
                /* display: flex; */
                position: fixed;
                text-align: center;
                bottom: 0;
                width: 100%;
                z-index: 999;
            }

            @media (min-width: 1100px) {
                #enqRow {
                    visibility: hidden;
                }
            }
        </style>
        @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')

    <script>
        function goalselect(goalId) {
            document.getElementById('goalselect').value = goalId;
        }

        function submitquiz(type) {
            console.log(type);
            console.log(document.getElementById('quemailids').value);
            if (type == 'personal') {
                document.getElementById('qunameerror').innerHTML = '';
                document.getElementById('quemailerror').innerHTML = '';
                document.getElementById('quemobileerror').innerHTML = '';


                quname = document.getElementById('quname').value;
                quemail = document.getElementById('quemailids').value;
                quemobile = document.getElementById('qumobile').value;

                if (quname && quemail && quemobile) {
                    document.getElementById('personalbtn').click();
                } else {
                    console.log(quemail);
                    if (!quname) {
                        document.getElementById('qunameerror').innerHTML = 'Please enter your name';
                    }
                    if (!quemail) {
                        document.getElementById('quemailerror').innerHTML = 'Please enter your email id';
                    }
                    if (!quemobile) {
                        document.getElementById('quemobileerror').innerHTML = 'Please enter valid mobile number';
                    }

                }
            } else if (type == 'goal') {
                document.getElementById('qgoalerror').innerHTML = '';

                qgoal = document.getElementById('goalselect').value;
                if (qgoal) {
                    document.getElementById('goalbtn').click();
                } else {
                    document.getElementById('qgoalerror').innerHTML = 'Please select your goal';
                }
            } else if (type == 'heightweight') {
                document.getElementById('qheighterror').innerHTML = '';
                document.getElementById('qweighterror').innerHTML = '';
                document.getElementById('qageerror').innerHTML = '';
                document.getElementById('qgendererror').innerHTML = '';

                qheight = document.getElementById('qheight').value;
                qweight = document.getElementById('qweight').value;
                qage = document.getElementById('qage').value;
                qgender = document.getElementById('qgender').value;

                if (qheight && qweight && qage && qgender) {
                    if (!(qheight > 92 && qheight < 244)) {
                        document.getElementById('qheighterror').innerHTML = 'Please enter valid height between 92cm to 244cm';
                    } else if (!(qweight > 20 && qweight < 200)) {
                        document.getElementById('qweighterror').innerHTML = 'Please enter valid weight between 20Kg to 200Kg';
                    } else if (!(qage > 10 && qage < 80)) {
                        document.getElementById('qageerror').innerHTML = 'Please enter valid age between 10 to 80';
                    } else {
                        qgender = document.getElementById('qgender').value;

                        BMI = 0;
                        BMI = qweight / (qheight / 100 * qheight / 100);
                        BMR = 0;
                        if (qgender == 'Male') {
                            BMR = 10 * qweight + 6.25 * qheight - 5 * qage + 5;
                        } else if (qgender == 'Female') {
                            BMR = 10 * qweight + 6.25 * qheight - 5 * qage - 161;
                        }

                        if (BMI.toFixed(2) < 18) {
                            document.getElementById('less19').style.display = 'inline-block';
                            document.getElementById('more25').style.display = 'none';
                        } else if (BMI.toFixed(2) > 24) {
                            document.getElementById('more25').style.display = 'inline-block';
                            document.getElementById('less19').style.display = 'none';
                        } else {
                            document.getElementById('less19').style.display = 'none';
                            document.getElementById('more25').style.display = 'none';
                        }
                        document.getElementById('BMIShow').innerHTML = BMI.toFixed(2);
                        document.getElementById('BMRShow').innerHTML = BMR.toFixed(2);

                        document.getElementById('heightweightbtn').click();
                    }

                } else {
                    if (!qheight) {
                        document.getElementById('qheighterror').innerHTML = 'Please enter your height';
                    }
                    if (!qweight) {
                        document.getElementById('qweighterror').innerHTML = 'Please enter your weight';
                    }
                    if (!qage) {
                        document.getElementById('qageerror').innerHTML = 'Please enter your age';
                    }
                    if (!qgender) {
                        document.getElementById('qgendererror').innerHTML = 'Please select your gender';
                    }
                }
            } else if (type == 'final') {
                qheight = document.getElementById('qheight').value;
                qweight = document.getElementById('qweight').value;
                qage = document.getElementById('qage').value;
                qgoal = '';
                quname = document.getElementById('quname').value;
                quemail = document.getElementById('quemail').value;
                quemobile = document.getElementById('qumobile').value;
                qgender = document.getElementById('qgender').value;
                BMI = document.getElementById('BMIShow').innerHTML;
                BMR = document.getElementById('BMRShow').innerHTML;

                sendnotify('Thank You !');

                signupdata = {
                    quname: quname,
                    quemail: quemail,
                    quemobile: quemobile,
                    qgender: qgender,
                    qgoal: qgoal,
                    qage: qage,
                    qweight: qweight,
                    qheight: qheight,
                    qheight: qheight,
                    qheight: qheight,
                    BMI: BMI,
                    BMR: BMR,
                }
                $.ajax({
                    url: '/app/quizsignup',
                    type: "post",
                    data: signupdata,
                    success: function(data) {
                        if (data['status'] == 'emailerror') {
                            document.getElementById('signupemail').innerHTML = data['message'];
                        } else if (data['status'] == 'phoneerror') {
                            document.getElementById('signupphone').innerHTML = data['message'];
                        } else if (data['status'] != 200) {
                            document.getElementById('showerror').style.display = 'block';
                            document.getElementById('mainerror').innerHTML = data['message'];
                        } else if (data['status'] == 200) {
                            window.location = data['message'];
                        }
                    }
                });

            }
        }
    </script>
</body>



</html>