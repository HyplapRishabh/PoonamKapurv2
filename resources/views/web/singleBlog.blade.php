<!doctype html>
<html lang="en" dir="ltr">

<!--    08:54:35 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Poonamkapur - blog | balance healthy diet food in mumbai </title>

    <meta name="description" content=" Get the proper guidance for your health and diet on poonamkapur blogs. Customised Healthy Meal Plans Delivered in Mumbai.">

    <meta name="keywords" content=" healthy food, balanced diet, healthy diet, diet foods, healthy recipes, healthy meals, healthy meal plans, healthy foods to eat, eat healthy food, healthy food for weight loss, healthy indian food.">


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
            <!-- <div >
                <div class="" style="background-image: url('/{{$blog->coverImage}}'); background-size: contain; background-position: center; background-repeat: no-repeat; height: 100vh; width: 90vw;">
                </div>
                daw
            </div> -->

            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="/{{$blog->coverImage}}" alt="" style="height: 60vh; width: 90vw;">
                        </div>
                        <!-- blog creation date -->

                        <div class="mt-5">
                            <div class="card ">
                                <div class="card-body">
                                    <h2 class="mb-3">{{$blog->title}}</h2>
                                    <p><i class="fa fa-calendar" style="color: #EA6A12;" aria-hidden="true"></i> {{date('d M, Y', strtotime($blog->created_at))}} <i class="fa fa-user" style="color: #EA6A12;" aria-hidden="true"></i> {{$blog->writer}}</p>
                                    <h5 class="text-muted">{{$blog->subtitle}}</h5>
                                    <p class="">{!!$blog->description1!!}</p>
                                    <p class="">{!!$blog->description2!!}</p>
                                    <?php
                                    $tags = explode(',', $blog->tags);

                                    ?>
                                    @foreach($tags as $tag)
                                    <a href="#!" class="btn btn-primary">{{$tag}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-header">
                            <h2 class="card-title list-main">Similar Blogs</h2>
                        </div>
                        @foreach($blogs as $blogl)
                        @if($blogl->id != $blog->id)
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="card">
                                <img src="/{{$blogl->coverImage}}" class="card-img-top" alt="#">
                                <div class="card-body">
                                    <h5 class="card-title" style="display: -webkit-box; text-overflow: ellipsis; overflow: hidden; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{$blogl->title}}</h5>
                                    <p class="card-text" style="display: -webkit-box; text-overflow: ellipsis; overflow: hidden; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">{{$blogl->subtitle}}</p>
                                    <a href="{{url('/app/allblogs')}}/{{$blogl->slug}}" class="btn btn-primary">View Blog</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')
</body>

</html>