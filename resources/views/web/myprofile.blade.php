<!doctype html>
<html lang="en" dir="ltr">

<!--    08:54:35 GMT -->

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
                <path d="M4.05078 189.348C86.8841 109.514 348.951 -25.2523 734.551 74.3477C1120.15 173.948 1641.22 91.181 1853.55 37.3477" stroke="#EA6A12" stroke-opacity="0.3" />
                <path d="M0.99839 152.331C90.9502 80.6133 364.495 -28.9952 739.062 106.31C1113.63 241.616 1640.16 208.056 1856.6 174.363" stroke="#EA6A12" stroke-opacity="0.3" />
            </svg>
        </div>
    </div>

    <main class="main-content">
        <div class="position-relative">
            @include('web.weblayout.headerlayout')
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Update Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">

                            <div class="alert alert-danger alert-dismissible fade show" id="alertBox" style="display: none;" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Incorrect Otp!</strong> Please try again.
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Full name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{Auth::user() != null ? Auth::user()->name : ''}}" placeholder="User Name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{Auth::user() != null ? Auth::user()->email : ''}}" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Mobile number</label>
                                        <input type="text" maxlength="10" minlength="10" onkeyup="mobileField()" class="form-control" id="phone" name="phone" value="{{Auth::user() != null ? Auth::user()->phone : ''}}" placeholder="Phone" />
                                        <span class="text-danger" id="phoneerror"></span>
                                    </div>
                                </div>
                                <div class="col-md-6" id="otpDiv" style="display: none;">
                                    <div class="form-group">
                                        <div class="d-flex" style="justify-content: space-between; align-items: center; ">
                                            <label class="form-label">Otp</label>
                                            <a href="javascript:void(0)" id="otptext" class=" text-primary " style="font-size: 12px;" onclick="sendOtp()">Send Otp</a>
                                            <a href="javascript:void(0)" id="otptimer" class=" text-primary" style="font-size: 12px; display: none; "></a>

                                        </div>

                                        <input type="text" maxlength="4" class="form-control" style="position: relative;" id="otp" onkeyup="checkOtp()" placeholder="Enter Otp" />
                                        <!-- <a href="javascript:void(0)" id="verify" class=" text-primary" style="font-size: 12px;  position: absolute; right: 20px; top: 50%;" onclick="verifyOtp()">Verify Otp</a> -->

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Height (in inches)</label>
                                        <?php

                                        use Illuminate\Support\Facades\Auth;

                                        $height = Auth::user() != null ? Auth::user()->height : '';
                                        // convert height from cm to inch
                                        if ($height != '') {
                                            $height = $height / 2.54;
                                            $height = round($height, 0);
                                        }
                                        ?>
                                        <input type="text" class="form-control" id="qheight" name="qheight" value="{{$height}}" placeholder="Enter Height" />
                                        <span id='qheighterror' class="errorshow"></span>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Weight (in kgs) </label>
                                        <input type="number" id="qweight" class="form-control" name="qweight" value="{{Auth::user() != null ? Auth::user()->weight : ''}}" placeholder="Enter Your Weight in KG" />
                                        <span id='qweighterror' class="errorshow"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Age</label>
                                        <input type="text" id="qage" class="form-control" name="qage" value="{{Auth::user() != null ? Auth::user()->age : ''}}" placeholder="Enter Your Age" />
                                        <span id='qageerror' class="errorshow"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Gender</label>
                                        <select class="form-control" name="gender" id="qgender">
                                            <option value="">Select gender</option>
                                            @if (Auth::user())
                                            <option value="Male" {{Auth::user()->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                            @else
                                            <option value="Male">Male</option>
                                            @endif
                                            @if (Auth::user())
                                            <option value="Female" {{Auth::user()->gender == 'Female' ? 'selected' : ''}}>Female</option>
                                            @else
                                            <option value="Female">Female</option>
                                            @endif
                                        </select>
                                        <span id='qgendererror' class="errorshow"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updateBtn" onclick="updateInfo()" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content-inner mt-5 py-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-main">
                        <div class="card mb-0 iq-content rounded-bottom">
                            <div class="d-flex flex-wrap align-items-center justify-content-between mx-3 my-3">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="profile-img22 position-relative me-3 mb-3 mb-lg-0">
                                        <img src="{{asset('webassets/images/User-profile/1.png')}}" class="img-fluid avatar avatar-100 avatar-rounded" alt="profile-image">
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mb-sm-0">
                                        <div>
                                            <h6 class="me-2 text-primary">{{Auth::user() != null ? Auth::user()->name : ''}}</h6>
                                            <!-- <span><svg width="19" height="19" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M21 10.8421C21 16.9172 12 23 12 23C12 23 3 16.9172 3 10.8421C3 4.76697 7.02944 1 12 1C16.9706 1 21 4.76697 21 10.8421Z" stroke="#07143B" stroke-width="1.5"/>
                                 <circle cx="12" cy="9" r="3" stroke="#07143B" stroke-width="1.5"/>
                                 </svg><small class="mb-0 text-dark">Andheri, India</small></span> -->
                                        </div>
                                        <div class="ms-4 d-flex" style="justify-content: center; align-items: center; ">
                                            <div class="">
                                                <p class="mb-0 text-dark">{{Auth::user() != null ? Auth::user()->email : ''}}</p>
                                                <p class="mb-0 text-dark">+91-{{Auth::user() != null ? Auth::user()->phone : ''}}</p>
                                            </div>
                                            <div style="margin-left: 10px;">
                                                <a class="text-primary" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil-square" style="font-size: 20px;" aria-hidden="true"></i></a>
                                            </div>
                                        </div>


                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->



                                        <!-- Optional: Place to the bottom of scripts -->
                                        <script>
                                            const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                                        </script>
                                    </div>
                                </div>
                                <ul class="d-flex mb-0 text-center ">
                                    <!-- <li class="badge bg-primary py-2 me-2">
                           <p class="mb-3 mt-2">Weight Loss</p>
                           <small class="mb-1 fw-normal">My Goal</small>
                        </li> -->
                                    <li class="badge bg-primary py-2 me-2">
                                        <p class="mb-3 mt-2">{{Auth::user() != null ? Auth::user()->height : ''}} Cm</p>
                                        <small class="mb-1 fw-normal">Height</small>
                                    </li>
                                    <li class="badge bg-primary py-2 me-2">
                                        <p class="mb-3 mt-2">{{Auth::user() != null ? Auth::user()->weight : ''}} Kg</p>
                                        <small class="mb-1 fw-normal">Weight </small>
                                    </li>
                                    <li class="badge bg-primary py-2 me-2">
                                        <p class="mb-3 mt-2">{{Auth::user() != null ? Auth::user()->bmi : ''}}</p>
                                        <small class="mb-1 fw-normal">BMI </small>
                                    </li>
                                    <li class="badge bg-primary py-2 me-2">
                                        <p class="mb-3 mt-2">{{Auth::user() != null ? Auth::user()->bmr : ''}}</p>
                                        <small class="mb-1 fw-normal">BMR </small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-header-img">
                            <img src="{{asset('webassets/images/User-profile/01.png')}}" alt="header" class="img-fluid w-100 rounded" style="object-fit: contain;">
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-inner mt-5 py-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-0 border-0">
                                <div class="header-title ">
                                    <h4 class="card-title">My Order History</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab-fill" data-bs-toggle="pill" href="#pills-home-fill" role="tab" aria-controls="pills-home" aria-selected="true">AlaCart Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab-fill" data-bs-toggle="pill" href="#pills-profile-fill" role="tab" aria-controls="pills-profile" aria-selected="false">Subscription Orders</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent-1">
                                    <div class="tab-pane fade show active" id="pills-home-fill" role="tabpanel" aria-labelledby="pills-home-tab-fill">
                                        @if(count($orderdetails) != 0)
                                        @foreach($orderdetails as $orderinfo)
                                        <div class="d-flex flex-wrap justify-content-between">
                                            <div class="d-flex align-items-center flex-wrap mb-4 mb-lg-0">
                                                <button type="button" class="btn btn-outline-primary me-5 rounded-pill">#INV-{{$orderinfo['invoiceno']}}</button>

                                            </div>
                                            <div class="d-flex flex-wrap">
                                                <!-- <button type="button" class="btn btn-outline-danger rounded-pill">Cancel Order</button> -->
                                                <button type="button" class="btn text-white btn-success ms-3 rounded-pill">{{$orderinfo['deliverystatus']}}</button>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                <div class="card table-responsive">
                                                    <table class="table table-borderless product-table rounded">
                                                        <thead class="bg-primary ">
                                                            <tr>
                                                                <th><span class="heading-title rowpad text-white">Items</span>
                                                                </th>
                                                                <th><span class="heading-title rowpad text-white">Qty</span>
                                                                </th>
                                                                <th><span class="heading-title rowpad text-white">Price</span>
                                                                </th>
                                                                <th><span class="heading-title rowpad text-white">Total
                                                                        Price</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($orderinfo['trxalacartorder'] as $alacartinfo)
                                                            <tr class="cart_item border-bottom">
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="{{asset($alacartinfo->productImg)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$alacartinfo->productName}}" class="img-fluid avatar-rounded avatar-70">
                                                                        <div class="d-flex ms-4">
                                                                            <div>
                                                                                <h6 class="heading-title text-primary">
                                                                                    {{$alacartinfo->productName}}
                                                                                </h6>
                                                                                @if(isset($alacartinfo->addonName))
                                                                                <p class="mb-0 fw-bolder">
                                                                                    {{$alacartinfo->addonName}}
                                                                                </p>
                                                                                @else
                                                                                <p class="mb-0 fw-bolder">
                                                                                    {{$alacartinfo->addonName}}
                                                                                </p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <span class="rowpad">{{$alacartinfo->qty}}x</span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <span class="rowpad">{{$alacartinfo->productPrice +
                                                                    $alacartinfo->addonprice}}</span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <span class="rowpad">{{($alacartinfo->productPrice +
                                                                    $alacartinfo->addonprice)*$alacartinfo->qty}}</span>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <h4 class="text-center">No Orders Found</h4>
                                                        <p class="text-center">You have not ordered anything yet.</p>
                                                        <a href="{{url('/app/category/indian-meals?category=indian-meals')}}" class="btn btn-primary rounded-pill">Browse Products</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile-fill" role="tabpanel" aria-labelledby="pills-profile-tab-fill">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped" data-toggle="data-table">
                                                    <thead>
                                                        <tr class="ligth">
                                                            <th>Package Name</th>
                                                            <th>Total days</th>
                                                            <th>Total meals</th>
                                                            <th>Booked for</th>
                                                            <th>Start Date</th>
                                                            <th>Payment</th>
                                                            <th>Status</th>
                                                            <th style="min-width: 100px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($subscriptiondetails as $subdetails)
                                                        <tr>

                                                            <td>
                                                                @if(isset($subdetails->trxsubscriptionorder->pkgdtl))
                                                                {{$subdetails->trxsubscriptionorder->pkgdtl->name}}
                                                                @else

                                                                @endif
                                                            </td>
                                                            <td>{{$subdetails->trxsubscriptionorder->totaldays}}</td>
                                                            <td>{{$subdetails->trxsubscriptionorder->totalmeal}}</td>
                                                            <td>{{$subdetails->trxsubscriptionorder->subscribedfor}}</td>
                                                            <td>{{$subdetails->trxsubscriptionorder->startdate}}</td>
                                                            <td>{{$subdetails->subtotalamt}}</td>
                                                            <td>{{$subdetails->trxsubscriptionorder->status}}</td>
                                                            <td>
                                                                @if($subdetails->trxsubscriptionorder->status!='cancelled')
                                                                <div class="flex align-items-center list-user-action">

                                                                    <!-- <a class="btn btn-sm btn-icon btn-warning"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Pause subscription" data-original-title="Edit" href="#">
                                                                <span class="btn-inner">
                                                                    <svg width="20" viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                            stroke="currentColor"
                                                                            stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path fill-rule="evenodd"
                                                                            clip-rule="evenodd"
                                                                            d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                            stroke="currentColor"
                                                                            stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M15.1655 4.60254L19.7315 9.16854"
                                                                            stroke="currentColor"
                                                                            stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>
                                                                </span>
                                                            </a> -->
                                                                    @if($subdetails->trxsubscriptionorder->status == 'Booked' )
                                                                    <a class="btn btn-sm btn-icon btn-warning" title="Pause subscription" data-bs-toggle="modal" data-bs-target="#exampleModalPause{{$subdetails->id}}">
                                                                        <span class="btn-inner">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                                    <path d="M8,6 L10,6 C10.5522847,6 11,6.44771525 11,7 L11,17 C11,17.5522847 10.5522847,18 10,18 L8,18 C7.44771525,18 7,17.5522847 7,17 L7,7 C7,6.44771525 7.44771525,6 8,6 Z M14,6 L16,6 C16.5522847,6 17,6.44771525 17,7 L17,17 C17,17.5522847 16.5522847,18 16,18 L14,18 C13.4477153,18 13,17.5522847 13,17 L13,7 C13,6.44771525 13.4477153,6 14,6 Z" fill="#ffffff" />
                                                                                </g>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    @else
                                                                    <a class="btn btn-sm btn-icon btn-success" title="Resume subscription" data-bs-toggle="modal" data-bs-target="#exampleModalResume{{$subdetails->id}}">
                                                                        <span class="btn-inner">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                                    <path d="M9.82866499,18.2771971 L16.5693679,12.3976203 C16.7774696,12.2161036 16.7990211,11.9002555 16.6175044,11.6921539 C16.6029128,11.6754252 16.5872233,11.6596867 16.5705402,11.6450431 L9.82983723,5.72838979 C9.62230202,5.54622572 9.30638833,5.56679309 9.12422426,5.7743283 C9.04415337,5.86555116 9,5.98278612 9,6.10416552 L9,17.9003957 C9,18.1765381 9.22385763,18.4003957 9.5,18.4003957 C9.62084305,18.4003957 9.73759731,18.3566309 9.82866499,18.2771971 Z" fill="#fff" />
                                                                                </g>
                                                                            </svg>
                                                                        </span>
                                                                    </a>

                                                                    @endif
                                                                    <a class="btn btn-sm btn-icon btn-danger" title="Delete subscription" data-original-title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModaldelete{{$subdetails->id}}">
                                                                        <span class="btn-inner">
                                                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                                </path>
                                                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="exampleModalPause{{$subdetails->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalPause{{$subdetails->id}}" aria-hidden="true">
                                                            <div class="modal-dialog " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Pause Subscription</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <form>
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <input type="hidden" value="{{$subdetails->id}}" name="subId">
                                                                            <p>Are you sure you want to pause subscription @if(isset($subdetails->trxsubscriptionorder->pkgdtl))
                                                                                of {{$subdetails->trxsubscriptionorder->pkgdtl->name}}
                                                                                @endif
                                                                            </p>
                                                                            <p>Note: Subscription will be discontinued from tomorrow</p>
                                                                        </div>
                                                                        <div class="modal-footer" style="text-align: center;justify-content: center;">
                                                                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                                                                            <button type="button" onclick="pausesub({{$subdetails->id}})" style="" class="btn btn-primary rounded-pill">Pause</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="exampleModalResume{{$subdetails->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalResue{{$subdetails->id}}" aria-hidden="true">
                                                            <div class="modal-dialog " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Resume Subscription</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <form>
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <input type="hidden" value="{{$subdetails->id}}" name="subId">
                                                                            <p>Are you sure you want to resume subscription @if(isset($subdetails->trxsubscriptionorder->pkgdtl))
                                                                                of {{$subdetails->trxsubscriptionorder->pkgdtl->name}}
                                                                                @endif
                                                                            </p>
                                                                            <p>Note: Subscription will be continue from tomorrow</p>
                                                                        </div>
                                                                        <div class="modal-footer" style="text-align: center;justify-content: center;">
                                                                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                                                                            <button type="button" onclick="resumesub({{$subdetails->id}})" style="" class="btn btn-primary rounded-pill">Resume</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="exampleModaldelete{{$subdetails->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModaldelete{{$subdetails->id}}" aria-hidden="true">
                                                            <div class="modal-dialog " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Delete Subscription</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <form>
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <input type="hidden" value="{{$subdetails->id}}" name="subId">
                                                                            <p>Are you sure you want to stop subscription @if(isset($subdetails->trxsubscriptionorder->pkgdtl))
                                                                                of {{$subdetails->trxsubscriptionorder->pkgdtl->name}}
                                                                                @else
                                                                                @endif
                                                                            </p>
                                                                            <p>Note: Subscription will be discontinued from tomorrow</p>
                                                                        </div>
                                                                        <div class="modal-footer" style="text-align: center;justify-content: center;">
                                                                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                                                                            <button type="button" onclick="deletesub({{$subdetails->id}})" style="" class="btn btn-primary rounded-pill">Delete</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-bottom share-offcanvas" tabindex="-1" id="share-btn" aria-labelledby="shareBottomLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="shareBottomLabel">Share</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body small">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="text-center me-3 mb-3">
                            <img src="{{asset('webassets/images/brands/08.png')}}" class="img-fluid rounded mb-2" alt="">
                            <h6>Facebook</h6>
                        </div>
                        <div class="text-center me-3 mb-3">
                            <img src="{{asset('webassets/images/brands/09.png')}}" class="img-fluid rounded mb-2" alt="">
                            <h6>Twitter</h6>
                        </div>
                        <div class="text-center me-3 mb-3">
                            <img src="{{asset('webassets/images/brands/10.png')}}" class="img-fluid rounded mb-2" alt="">
                            <h6>Instagram</h6>
                        </div>
                        <div class="text-center me-3 mb-3">
                            <img src="{{asset('webassets/images/brands/11.png')}}" class="img-fluid rounded mb-2" alt="">
                            <h6>Google Plus</h6>
                        </div>
                        <div class="text-center me-3 mb-3">
                            <img src="{{asset('webassets/images/brands/13.png')}}" class="img-fluid rounded mb-2" alt="">
                            <h6>In</h6>
                        </div>
                        <div class="text-center me-3 mb-3">
                            <img src="{{asset('webassets/images/brands/12.png')}}" class="img-fluid rounded mb-2" alt="">
                            <h6>YouTube</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')9
    @include('web.weblayout.webscript')

    <script>
        function deletesub(subid) {
            $.ajax({
                url: '/app/deletesubscription/' + subid,
                type: "get",
                success: function(data) {
                    console.log(data);
                    if (data['status'] == "success") {
                        $('#exampleModaldelete' + subid).modal('hide');
                        sendnotify(data['message']);
                        location.reload();
                    } else {
                        sendnotify(data['message']);
                    }
                }
            });
        }

        function pausesub(subid) {
            $.ajax({
                url: '/app/pausesubscription/' + subid,
                type: "get",
                success: function(data) {
                    console.log(data);
                    if (data['status'] == "success") {
                        $('#exampleModalPause' + subid).modal('hide');
                        sendnotify(data['message']);
                        location.reload();
                    } else {
                        sendnotify(data['message']);
                    }
                }
            });
        }

        function resumesub(subid) {
            $.ajax({
                url: '/app/resumesubscription/' + subid,
                type: "get",
                success: function(data) {
                    console.log(data);
                    if (data['status'] == "success") {
                        $('#exampleModalResume' + subid).modal('hide');
                        sendnotify(data['message']);
                        location.reload();
                    } else {
                        sendnotify(data['message']);
                    }
                }
            });
        }
    </script>

    <script>
        var updateBtn = $('#updateBtn');
        var maxTime = 30;
        var random = '';

        function mobileField() {

            var oldPhone = '{{Auth::user()->phone}}';
            console.log(oldPhone);
            var newPhone = $('#phone').val();

            // indian phonenumber validation starting with 6,7,8,9
            var regex = /^[6-9]\d{9}$/;

            if (regex.test(newPhone)) {
                $('#phoneerror').html('');
                if (oldPhone != newPhone) {
                    $.ajax({
                        url: "{{url('app/profile/checkPhone')}}/" + newPhone,
                        success: function(response) {

                            if(response.status == 200 )
                            {

                                $('#phoneerror').html('');
                                updateBtn.attr('disabled', false);
                                $('#otpDiv').css('display', 'block');
                                // updateBtn.attr('disabled', true);
                                $('#otp').val('');
                            } else if(response.status == 400)
                            {
                                $('#phoneerror').html('Phone number already exists');
                                updateBtn.attr('disabled', true);
                                $('#otpDiv').css('display', 'none');
                                $('#otp').val('');
                            }

                        },
                        error: function(response) {
                            console.log(response);
                            $('#phoneerror').html('');
                            updateBtn.attr('disabled', true);
                            $('#otpDiv').css('display', 'block');
                            $('#otp').val('');
                        }
                    });

                } else {
                    $('#otpDiv').css('display', 'none');
                    updateBtn.attr('disabled', false);
                }
            } else {
                $('#phoneerror').html('Invalid phone number');
                updateBtn.attr('disabled', true);
            }



        }

        function checkOtp() {
            var otp = $('#otp').val();
            if (otp.length == 4) {
                updateBtn.attr('disabled', false);
            } else {
                updateBtn.attr('disabled', true);
            }
        }

        function updateInfo() {

            name = document.getElementById('name').value;
            email = document.getElementById('email').value;
            phone = document.getElementById('phone').value;

            document.getElementById('qheighterror').innerHTML = '';
            document.getElementById('qweighterror').innerHTML = '';
            document.getElementById('qageerror').innerHTML = '';

            qheight = document.getElementById('qheight').value;
            qheight = qheight * 2.54;
            qheight = Math.round(qheight);
            qweight = document.getElementById('qweight').value;
            qage = document.getElementById('qage').value;
            qgender = document.getElementById('qgender').value;

            if (qheight && qweight && qage && qgender) {
                if (!(qheight > 92 && qheight < 244)) {
                    document.getElementById('qheighterror').innerHTML = 'Please enter valid height between 36 inches to 96 inches';
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

                    if (random == $('#otp').val()) {

                        $.ajax({
                            type: "post",
                            url: "{{url('/app/profile/updateDetails')}}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "name": name,
                                "email": email,
                                "phone": phone,
                                "height": qheight,
                                "weight": qweight,
                                "age": qage,
                                "gender": qgender,
                                "bmi": BMI.toFixed(2),
                                "bmr": BMR.toFixed(2),
                            },
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                location.reload();
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });

                    } else {
                        $('#alertBox').css('display', 'block');
                    }

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
        }

        function sendOtp() {
            var uphone = document.getElementById('phone').value;
            random = Math.floor(Math.random() * 9000 + 1000);
            if (uphone) {

                $.ajax({
                    url: '{{url("app/sendotp")}}/' + uphone + '/' + random,
                    success: function(data) {
                        console.log(data);
                        if (data['status'] == 'phoneerror') {
                            document.getElementById('signupphone').innerHTML = data['message'];
                        } else {
                            StartTimer();
                            // document.getElementById('signupphone').innerHTML = random;
                            // document.getElementById('showsuccess').style.display = 'block';
                            // document.getElementById('mainsuccess').innerHTML = data['message'];
                        }
                    }
                });

            } else {
                document.getElementById('signupphone').innerHTML = 'Please enter mobile number for OTP';
            }
        }

        function StartTimer() {
            console.log(maxTime);
            setTimeout(x => {
                if (maxTime <= 0) {}
                maxTime -= 1;
                if (maxTime > 0) {
                    document.getElementById('otptext').style.display = 'none';
                    document.getElementById('otptimer').style.display = 'block';
                    document.getElementById('otptimer').innerHTML = '00:' + maxTime;
                    this.StartTimer();
                    console.log(maxTime);
                } else {
                    maxTime = 30;
                    document.getElementById('otptext').style.display = 'block';
                    document.getElementById('otptimer').style.display = 'none';
                }
            }, 1000);
        }
    </script>
</body>

</html>