<div class="position-relative">
            <!--Nav Start-->
            <nav class="nav navbar navbar-expand-lg  iq-navbar">
                <div class="container-fluid navbar-inner">

                    <div class="logo-hover">
                        <a href="{{url('/')}}"> <img src="{{asset('webassets/images/logo.png')}}" class="img-fluid logo-img" alt="img4"></a>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <span class="navbar-toggler-bar bar1 mt-2"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto align-items-center navbar-list mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a href="{{url('/')}}" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                                    <p class=" current">Home</p>
                                    <span class="bg-danger dots"></span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="{{url('/app/allcategory')}}" class="nav-link" id="notification-drop"
                                    data-bs-toggle="dropdown">
                                    <p>Categories</p>
                                    <span class="bg-danger dots"></span>
                                </a>
                                <div class="sub-drop dropdown-menu dropdown-menu-end p-0"
                                    aria-labelledby="notification-drop">
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
                                                        <img class="avatar-40 rounded-pill" src="{{asset($catinfo->image)}}"  onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$catinfo->name}}">
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
                                <a href="{{url('/app/allpackage')}}" class="nav-link" id="notification-drop"
                                    data-bs-toggle="dropdown">
                                    <p>Packages</p>
                                    <span class="bg-danger dots"></span>
                                </a>
                                <div class="sub-drop dropdown-menu dropdown-menu-end p-0"
                                    aria-labelledby="notification-drop">
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
                                                        <img class="avatar-40 rounded-pill" src="{{asset($packageinfo->image)}}"  onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$packageinfo->name}}">
                                                        <div class="ms-3 w-100">
                                                            <h6 class="mb-0 ">{{$packageinfo->name}}</h6>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                @if(isset($packageinfo->goalId))
                                                                <p class="mb-0">{{$packageinfo->goal->name}}</p>
                                                                @else
                                                                <p class="mb-0">Check Now</p>
                                                                @endif
                                                                <!-- <small class="float-end font-size-12">Check Now</small> -->
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
                                <a href="{{url('/app/aboutus')}}" class="nav-link" id="notification-drop">
                                    <p>About Us</p>
                                    <span class="bg-danger dots"></span>
                                </a>

                            </li>
                            <li class="nav-item dropdown">
                                <a href="{{url('/app/Franchisee')}}"  class="nav-link" id="notification-drop">
                                    <p>Our Franchisee</p>
                                    <span class="bg-danger dots"></span>
                                </a>

                            </li>
                            <li class="nav-item dropdown">
                                <a href="{{url('/app/contact-us')}}" class="nav-link" id="notification-drop">
                                    <p>Contact Us</p>
                                    <span class="bg-danger dots"></span>
                                </a>

                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('webassets/images/avatars/01.png')}}" alt="User-Profile"
                                        class="img-fluid avatar avatar-50 avatar-rounded">
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
            </nav> <!-- Nav Header Component Start -->
            <!-- Nav Header Component End -->
            <!--Nav End-->
        </div>