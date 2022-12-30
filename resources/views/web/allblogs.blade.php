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
        <div class="content-inner mt-5 py-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card " data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".8" data-iq-trigger="scroll" data-iq-ease="none">
                        <div class="hero-image p-3" style="background: url('../assets/images/User-profile/01.png') no-repeat center right;background-size: cover;background-position: center;">
                            <div class="card-body p-5">
                                <div class="row banner-container">
                                    <div class="col-lg-12 banner-item">

                                        <div class="banner-text pt-3">
                                            <h1 class="fw-bold mb-4 ">
                                                BLOGS
                                            </h1>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">                
                @foreach($blogs as $blog)
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <img src="/{{$blog->coverImage}}" class="card-img-top" alt="#">
                        <div class="card-body">
                            <h4 class="card-title" style="display: -webkit-box; text-overflow: ellipsis; overflow: hidden; -webkit-line-clamp: 2; -webkit-box-orient: vertical;" >{{$blog->title}}</h4>
                            <p class="card-text" style="display: -webkit-box; text-overflow: ellipsis; overflow: hidden; -webkit-line-clamp: 3; -webkit-box-orient: vertical;" >{{$blog->subtitle}}</p>
                            <a href="{{url('/app/allblogs')}}/{{$blog->slug}}" class="btn btn-primary">View Blog</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')
</body>

</html>