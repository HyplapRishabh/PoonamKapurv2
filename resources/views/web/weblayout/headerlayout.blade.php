<!-- <div class="position-relative"> -->
<!--Nav Start-->
<nav class="nav navbar navbar-expand-lg  iq-navbar">
    <div class="container-fluid navbar-inner">

        <div class="logo-hover">
            <a href="{{url('/')}}"> <img src="{{asset('webassets/images/logo.png')}}" class="img-fluid logo-img" alt="img4"></a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <span class="navbar-toggler-bar bar1 mt-2"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-center navbar-list mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a href="{{url('/')}}" class="nav-link" id="notification-drop">
                        <p style="font-size: 0.9rem">Home</p>
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{url('/app/aboutus')}}" class="nav-link" id="notification-drop">
                        <p style="font-size: 0.9rem">About Us</p>
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{url('/app/allcategory')}}" class="nav-link" id="notification-drop">
                        <p style="font-size: 0.9rem">Categories</p>
                        <span class="bg-danger dots"></span>
                    </a>
                    <div class="sub-drop dropdown-menu dropdown-menu-end p-0" aria-labelledby="notification-drop">
                        <div class="card shadow-none m-0">
                            <div class="card-header d-flex justify-content-between bg-primary mx-0 px-4">
                                <div class="header-title">
                                    <h5 class="mb-0 text-white">Our Categories</h5>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                @foreach($categorylist as $catinfo)
                                <a href="{{url('/app/category/')}}/{{Str::slug($catinfo->name)}}?category={{Str::slug($catinfo->name)}}" class="iq-sub-card">
                                    <div class="d-flex align-items-center">
                                        <img class="avatar-40 rounded-pill" src="{{asset($catinfo->image)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$catinfo->name}}">
                                        <div class="ms-3 w-100">
                                            <h6 class="mb-0 ">{{$catinfo->name}}</h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <!-- <p class="mb-0">Category Goal</p> -->
                                                <small class="float-end font-size-12">Check Now</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <!-- <a href="{{url('/allgoal')}}" class="nav-link" id="notification-drop" data-bs-toggle="dropdown"> -->
                    <a href="{{url('/app/allgoal')}}" class="nav-link">
                        <p style="font-size: 0.9rem">Goals</p>
                        <span class="bg-danger dots"></span>
                    </a>
                    <div class="sub-drop dropdown-menu dropdown-menu-end p-0" aria-labelledby="notification-drop">
                        <div class="card shadow-none m-0">
                            <div class="card-header d-flex justify-content-between bg-primary mx-0 px-4">
                                <div class="header-title">
                                    <h5 class="mb-0 text-white">Our Goals</h5>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                @foreach($goallist as $goalinfo)
                                <a href="{{url('/app/goal/')}}/{{Str::slug($goalinfo->name)}}?goal={{$goalinfo->id}}&pkgId={{$goalinfo->package->id}}&meal={{$goalinfo->package->mealtype->name}}" class="iq-sub-card">
                                    <div class="d-flex align-items-center">
                                        <img class="avatar-40 rounded-pill" src="{{asset($goalinfo->image)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$goalinfo->name}}">
                                        <div class="ms-3 w-100">
                                            <h6 class="mb-0 ">{{$goalinfo->name}}</h6>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>

                <!-- <li class="nav-item dropdown">
                        <a href="{{url('/app/allpackage')}}" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                            <p style="font-size: 0.9rem">Packages</p>
                            <span class="bg-danger dots"></span>
                        </a>
                        <div class="sub-drop dropdown-menu dropdown-menu-end p-0" aria-labelledby="notification-drop">
                            <div class="card shadow-none m-0">
                                <div class="card-header d-flex justify-content-between bg-primary mx-0 px-4">
                                    <div class="header-title">
                                        <h5 class="mb-0 text-white">Our Packages</h5>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    @foreach($packagelist as $packageinfo)
                                    <a href="{{url('/app/goal/')}}/{{Str::slug($packageinfo->goal->name)}}?goal={{$packageinfo->goalId}}&pkgId={{$packageinfo->id}}&meal={{$packageinfo->mealtype->name}}" class="iq-sub-card">
                                        <div class="d-flex align-items-center">
                                            <img class="avatar-40 rounded-pill" src="{{asset($packageinfo->image)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$packageinfo->name}}">
                                            <div class="ms-3 w-100">
                                                <h6 class="mb-0 ">{{$packageinfo->name}}</h6>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    @if(isset($packageinfo->goalId))
                                                    <p class="mb-0">{{$packageinfo->goal->name}}</p>
                                                    @else
                                                    <p class="mb-0">Check Now</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li> -->
                <li class="nav-item dropdown">
                    <a href="{{url('/app/consultation')}}" class="nav-link" id="notification-drop">
                        <p style="font-size: 0.9rem">Consultation</p>
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <!-- <a href="" class="nav-link" id="notification-drop" data-bs-toggle="modal" data-bs-target="#bulkEnquiry"> -->
                    <a href="{{url('/app/Bulk')}}" class="nav-link">
                        <p style="font-size: 0.9rem">Bulk enquires</p>
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <!-- <a href="{{url('/app/Franchisee')}}" class="nav-link" id="notification-drop" data-bs-toggle="modal" data-bs-target="#franchiseEnquiry"> -->
                    <a href="{{url('/app/Franchisee')}}" class="nav-link">
                        <p style="font-size: 0.9rem">Our Franchisee</p>
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{url('/app/allblogs')}}" class="nav-link" id="notification-drop">
                        <p style="font-size: 0.9rem">Blogs</p>
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{url('/app/contact-us')}}" class="nav-link" id="notification-drop">
                        <p style="font-size: 0.9rem">Contact Us</p>
                        <span class="bg-danger dots"></span>
                    </a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('webassets/images/avatars/01.png')}}" alt="User-Profile" class="img-fluid avatar avatar-50 avatar-rounded">
                        <!-- <h6 class="mb-0 caption-title">Login</h6> -->
                        <div class="caption ms-3 d-none d-md-block ">

                            <!-- <p class="mb-0 caption-sub-title">Marketing Administrator</p> -->
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item text-dark" href="user-profile.html">Profile</a></li>
                                    <li><a class="dropdown-item text-dark" href="user-privacy-setting.html">Privacy
                                            Setting</a></li> -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @if(Auth::user())
                        <li><a class="dropdown-item text-dark" href="{{url('/app/myprofile')}}">My Profile</a></li>
                        <li><a class="dropdown-item text-dark" href="{{url('/app/viewcart')}}">View Cart</a></li>
                        <li><a class="dropdown-item text-dark" href="{{url('/app/wallet')}}">Wallet</a></li>
                        <li><a class="dropdown-item text-dark" href="{{url('/app/weblogout')}}">Log out</a></li>
                        @else
                        <li><a class="dropdown-item text-dark" href="{{url('/app/login')}}">Login</a></li>
                        <li><a class="dropdown-item text-dark" href="{{url('/app/signup')}}">Sign Up</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> 
<!--Nav End-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .icon-bar {
        position: fixed;
        top: 50%;
        right: 0%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 999;
    }

    /* Style the icon bar links */
    .icon-bar a {
        display: block;
        text-align: center;
        padding: 7px;
        transition: all 0.3s ease;
        color: white;
        font-size: 13px;

    }

    /* Style the social media icons with color, if you want */
    .icon-bar a:hover {
        background-color: #000;
    }

    .facebook {
        background: #3B5998;
        color: white;
    }

    .twitter {
        background: #55ACEE;
        color: white;
    }

    .instagram {
        background: #ff0b46;
        color: white;
    }

    .linkedin {
        background: #007bb5;
        color: white;
    }

    .youtube {
        background: #bb0000;
        color: white;
    }

    .whatsapp {
        background: #2cb153;
        color: white;
    }
</style>

<div class="icon-bar">
    <a href="https://www.facebook.com/PoonamKapurTiffinsAndDietMeals?mibextid=LQQJ4d" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
    <a href="https://twitter.com/poonamkapur12?s=11&t=Io0OgmHClxzw8pvoMTxySg" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
    <a href="https://instagram.com/poonamkapurshealthykitchen?utm_medium=copy_link" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
    <a href="https://www.linkedin.com/posts/poonam-kapurs-kitchen-healthy-customized-diet-meals-services-in-mumbai-45b78113_poonamkapurshealthykitchen-prowok-highproteinmeals-activity-6941378619260690433-9LOn?utm_source=linkedin_share&utm_medium=android_app" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
    <a href="https://wa.me/9820097377?text=Hello%2C%20can%20you%20please%20help%20me%20with%20the%20diet%20plan%20%3F" target="_blank" class="whatsapp"><i class="fa fa-whatsapp"></i></a>
</div>
@if (Auth::user())
<a href="{{url('/app/viewcart')}}" class="float">
    <span class="badge badge-pill badge-danger notification" id="badgeforcart" style=" position: absolute; top: 0px; right: 0px; font-size: 10px; background-color: #000;">{{config('cartCount')}}</span>
    <i class="fa fa-shopping-cart my-float"></i>
</a>
@else
<a href="{{url('/app/login')}}" class="float">
    <span class="badge badge-pill badge-danger notification" id="badgeforcart" style=" position: absolute; top: 0px; right: 0px; font-size: 10px; background-color: #000;">{{config('cartCount')}}</span>
    <i class="fa fa-shopping-cart my-float"></i>
</a>
@endif

<style>
    .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 10px;
        background-color: #e98a34;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
    }

    .my-float {
        margin-top: 16px;
    }

    /* media query */
    @media only screen and (max-width: 913px) {
        .float {
            bottom: 80px;
        }
    }
</style>

<style>
    .oneLiner {
        display: -webkit-box;
        text-overflow: ellipsis;
        overflow: hidden;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .twoLiner {
        display: -webkit-box;
        text-overflow: ellipsis;
        overflow: hidden;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    /* custom scroll bar */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #fff;
    }

    ::-webkit-scrollbar-thumb {
        background: #EA6A12;
        border-radius: 10px;
    }
</style>
<!-- </div> -->

<script>
    // refresh div after 5 seconds
    // setInterval(function() {
    //     // div refresh
    //     $('#badgeforcart').load(location.href + ' #badgeforcart');
    // }, 2000);
</script>