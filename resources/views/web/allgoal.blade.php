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
            background-image:url("{{url('webassets/images/Goals.png')}}");
            background-repeat: no-repeat;
            height: 300px;
            border-radius: 15px;
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
        <div class="content-inner mt-5 py-0">
            <div class="row mb-3">
                <div class="col-sm-12 col-lg-12">
                    <div class="bd-example">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a>
                                        <img src="{{url('webassets/images/Goals.png')}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="Banner" class="d-block w-100" alt="#">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card-transparent bg-transparent mb-0">
                        <div class="card-body p-0">
                            <div class="col-xl-12 col-lg-12 dish-card-horizontal mt-2">
                                <div class="row  ">
                                    @foreach($goallist as $goalinfo)
                                    <div class="col-sm-12 col-md-6 col-lg-4 active" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                        <div class="card card-white dish-card profile-img mb-0">
                                            <a href="{{url('/app/goal/')}}/{{Str::slug($goalinfo->name)}}?goal={{$goalinfo->id}}&pkgId={{$goalinfo->package->id}}&meal={{$goalinfo->package->mealtype->name}}">
                                                <div class="profile-img21">
                                                    <img src="{{asset($goalinfo->image)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$goalinfo->name}}" class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom" alt="profile-image">
                                                    <img src="{{asset($goalinfo->image)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$goalinfo->name}}" class="img-fluid rounded-pill avatar-170 hover-image " alt="profile-image" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                                </div>
                                                <div class="card-body menu-image">
                                                    <h6 class="heading-title fw-bolder mt-4 mb-0 text-center">{{$goalinfo->name}}
                                                    </h6>

                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <!-- <span class="text-primary fw-bolder me-2">&#8377 750/-</span> -->
                                                            <!-- <small class="text-decoration-line-through">$8.49</small> -->
                                                        </div>
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect class="circle-1" width="24" height="24" rx="12" fill="currentColor" />
                                                            <rect class="circle-2" x="11.168" y="7" width="1.66667" height="10" rx="0.833333" fill="currentColor" />
                                                            <rect class="circle-3" x="7" y="12.834" width="1.66666" height="10" rx="0.833332" transform="rotate(-90 7 12.834)" fill="currentColor" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                    @endforeach
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