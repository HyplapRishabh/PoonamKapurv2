<div class="position-relative">
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
                        <a href="" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
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
                    <li class="nav-item dropdown">
                        <a href="{{url('/app/allcategory')}}" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
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
                        <a href="" class="nav-link" id="notification-drop" data-bs-toggle="modal" data-bs-target="#bulkEnquiry">
                            <p style="font-size: 0.9rem">Bulk enquires</p>
                            <span class="bg-danger dots"></span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{url('/app/Franchisee')}}" class="nav-link" id="notification-drop" data-bs-toggle="modal" data-bs-target="#franchiseEnquiry">
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
    </nav> <!-- Nav Header Component Start -->
    <!-- Nav Header Component End -->
    <!--Nav End-->

    <!-- Bulk Enquiry modal here -->
    <div id="bulkEnquiry" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="card-title" id="gridModalLabel">Bulk Enquiry</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" action="{{url('/app/submitBulkEnquiry')}}" class="text-center mt-3">
                            @csrf
                            <div class="form-card text-start">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Username: *</label>
                                            <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{Auth::user() != null ? Auth::user()->name : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Phone: *</label>
                                            <input type="text" class="form-control" name="phone" maxlength="10" placeholder="Phone" value="{{Auth::user() != null ? Auth::user()->phone : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email: *</label>
                                            <input type="email" class="form-control" id="quemail" name="email" placeholder="Email Id" value="{{Auth::user() != null ? Auth::user()->email : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Organisation Name: *</label>
                                            <input type="text" class="form-control" name="organisation" placeholder="Organisation Name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Daily/Once: *</label>
                                            <select type="text" class="form-control" name="type" placeholder="" required>
                                                <option value="Daily">Daily</option>
                                                <option value="Once">Once</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Call Back Date: *</label>
                                            <input type="date" class="form-control" name="callBackTime" placeholder="" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Message: *</label>
                                            <textarea class="form-control" name="message" placeholder="Enter Your Message" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary  text-center rounded">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Bulk Enquiry modal ends here -->

    <!-- Franchise Enquiry modal here -->
    <div id="franchiseEnquiry" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="card-title" id="gridModalLabel">Franchise Enquiry</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" action="{{url('/app/submitFranchiseEnquiry')}}" class="text-center mt-3">
                            @csrf
                            <div class="form-card text-start">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Username: *</label>
                                            <input type="text" class="form-control" name="name" value="{{Auth::user() != null ? Auth::user()->name : ''}}" placeholder="Your Name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Phone: *</label>
                                            <input type="text" class="form-control" name="phone" maxlength="10" placeholder="Phone" value="{{Auth::user() != null ? Auth::user()->phone : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email: *</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Id" value="{{Auth::user() != null ? Auth::user()->email : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Call Back Date: *</label>
                                            <input type="date" class="form-control" name="callBackTime" placeholder="" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Message: *</label>
                                            <textarea class="form-control" name="message" placeholder="Enter Your Message" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary  text-center rounded">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Franchise Enquiry modal ends here -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .icon-bar {
            position: fixed;
            top: 50%;
            right: 0%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
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

        .google {
            background: #dd4b39;
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
    </style>

    <div class="icon-bar">
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="google"><i class="fa fa-instagram"></i></a>
        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
        <a href="#" class="youtube"><i class="fa fa-youtube"></i></a>
    </div>