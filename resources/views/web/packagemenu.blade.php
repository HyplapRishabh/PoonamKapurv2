<!doctype html>
<html lang="en" dir="ltr">

<!-- special-pages/add-to-cart.html   08:53:12 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poonamkapur.com | {{$packageinfo['name']}}</title>

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
            <div class="card " data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6"
                data-iq-delay=".8" data-iq-trigger="scroll" data-iq-ease="none">
                <div class="hero-image p-3 bkgcategory">
                    <div class="card-body p-5">
                        <div class="row banner-container">
                            <div class="col-lg-12 banner-item">

                                <div class="banner-text pt-3">
                                    <h1 class="fw-bold mb-4 text-center">Menu For {{$packageinfo['name']}}</h1>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12 col-lg-12">

                    <div class="card-transparent mb-5">
                        <div class="card-body">

                            <div class="col-xl-12 col-lg-12 dish-card-horizontal mt-2">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-4">
                                    @foreach($menuinfo as $menulist)
                                        <br>
                                        @if(str_contains($input['type'], 'BreakFast'))
                                        @if(isset($menulist['webbreakfast']))
                                        <div class="col active">
                                            <div class="card card-white dish-card profile-img mb-0">
                                                <div class="profile-img21">
                                                    <img src="{{asset($menulist->webbreakfast->image)}}"
                                                    onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                                    alt="{{$menulist->webbreakfast->name}}"
                                                        class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom">
                                                    <img src="{{asset($menulist->webbreakfast->image)}}"
                                                    onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                                    alt="{{$menulist->webbreakfast->name}}"
                                                        class="img-fluid rounded-pill avatar-170 hover-image" data-iq-gsap="onStart" data-iq-opacity="0"
                                                        data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                                        data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                                </div>
                                                <div class="card-body menu-image">

                                                    <h6 class="heading-title fw-bolder mt-4 mb-0">{{$menulist->webbreakfast->name}}</h6>

                                                    <div class="card-rating stars-ratings">

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </div>
                                                    @if(isset($menulist->webbreakfast->macro))
                                                    <ul class="d-flex mb-0 text-center " style="padding-left: 0px;height: 70px;">
                                                        @if($menulist->webbreakfast->macro->calories!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webbreakfast->macro->calories}}</p>
                                                            <small class="mb-1 fw-normal">Calories</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webbreakfast->macro->carbs!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webbreakfast->macro->carbs}}</p>
                                                            <small class="mb-1 fw-normal">Carbs</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webbreakfast->macro->sugar!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webbreakfast->macro->sugar}}</p>
                                                            <small class="mb-1 fw-normal">Sugar</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webbreakfast->macro->fat!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webbreakfast->macro->fat}}</p>
                                                            <small class="mb-1 fw-normal">Fat</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webbreakfast->macro->iron!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webbreakfast->macro->iron}}</p>
                                                            <small class="mb-1 fw-normal">Iron</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webbreakfast->macro->mag!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webbreakfast->macro->mag}}</p>
                                                            <small class="mb-1 fw-normal">Magnesium</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webbreakfast->macro->sodium!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webbreakfast->macro->sodium}}</p>
                                                            <small class="mb-1 fw-normal">Sodium</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webbreakfast->macro->copper!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webbreakfast->macro->copper}}</p>
                                                            <small class="mb-1 fw-normal">Copper</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webbreakfast->macro->potasium!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webbreakfast->macro->potasium}}</p>
                                                            <small class="mb-1 fw-normal">Potasium</small>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                    @else
                                                    <div style="height: 70px;"></div>
                                                    @endif
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="text-primary fw-bolder me-2">Day {{$menulist->day}} (BreakFast)</span>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif

                                        @if(str_contains($input['type'], 'Lunch'))
                                        @if(isset($menulist['weblunch']))
                                        <div class="col active">
                                            <div class="card card-white dish-card profile-img mb-0">
                                                <div class="profile-img21">
                                                    <img src="{{asset($menulist->weblunch->image)}}"
                                                    onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                                    alt="{{$menulist->weblunch->name}}"
                                                        class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom">
                                                    <img src="{{asset($menulist->weblunch->image)}}"
                                                    onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                                    alt="{{$menulist->weblunch->name}}"
                                                        class="img-fluid rounded-pill avatar-170 hover-image" data-iq-gsap="onStart" data-iq-opacity="0"
                                                        data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                                        data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                                </div>
                                                <div class="card-body menu-image">

                                                    <h6 class="heading-title fw-bolder mt-4 mb-0">{{$menulist->weblunch->name}}</h6>

                                                    <div class="card-rating stars-ratings">

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </div>
                                                    @if(isset($menulist->weblunch->macro))
                                                    <ul class="d-flex mb-0 text-center " style="padding-left: 0px;height: 70px;">
                                                        @if($menulist->weblunch->macro->calories!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->weblunch->macro->calories}}</p>
                                                            <small class="mb-1 fw-normal">Calories</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->weblunch->macro->carbs!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->weblunch->macro->carbs}}</p>
                                                            <small class="mb-1 fw-normal">Carbs</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->weblunch->macro->sugar!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->weblunch->macro->sugar}}</p>
                                                            <small class="mb-1 fw-normal">Sugar</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->weblunch->macro->fat!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->weblunch->macro->fat}}</p>
                                                            <small class="mb-1 fw-normal">Fat</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->weblunch->macro->iron!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->weblunch->macro->iron}}</p>
                                                            <small class="mb-1 fw-normal">Iron</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->weblunch->macro->mag!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->weblunch->macro->mag}}</p>
                                                            <small class="mb-1 fw-normal">Magnesium</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->weblunch->macro->sodium!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->weblunch->macro->sodium}}</p>
                                                            <small class="mb-1 fw-normal">Sodium</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->weblunch->macro->copper!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->weblunch->macro->copper}}</p>
                                                            <small class="mb-1 fw-normal">Copper</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->weblunch->macro->potasium!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->weblunch->macro->potasium}}</p>
                                                            <small class="mb-1 fw-normal">Potasium</small>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                    @else
                                                    <div style="height: 70px;"></div>
                                                    @endif
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="text-primary fw-bolder me-2">Day {{$menulist->day}} (Lunch)</span>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                        @if(str_contains($input['type'], 'Snack'))
                                        @if(isset($menulist['websnacks']))
                                        <div class="col active">
                                            <div class="card card-white dish-card profile-img mb-0">
                                                <div class="profile-img21">
                                                    <img src="{{asset($menulist->websnacks->image)}}"
                                                    onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                                    alt="{{$menulist->websnacks->name}}"
                                                        class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom">
                                                    <img src="{{asset($menulist->websnacks->image)}}"
                                                    onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                                    alt="{{$menulist->websnacks->name}}"
                                                        class="img-fluid rounded-pill avatar-170 hover-image" data-iq-gsap="onStart" data-iq-opacity="0"
                                                        data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                                        data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                                </div>
                                                <div class="card-body menu-image">

                                                    <h6 class="heading-title fw-bolder mt-4 mb-0">{{$menulist->websnacks->name}}</h6>

                                                    <div class="card-rating stars-ratings">

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </div>
                                                    @if(isset($menulist->websnacks->macro))
                                                    <ul class="d-flex mb-0 text-center " style="padding-left: 0px;height: 70px;">
                                                        @if($menulist->websnacks->macro->calories!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->websnacks->macro->calories}}</p>
                                                            <small class="mb-1 fw-normal">Calories</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->websnacks->macro->carbs!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->websnacks->macro->carbs}}</p>
                                                            <small class="mb-1 fw-normal">Carbs</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->websnacks->macro->sugar!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->websnacks->macro->sugar}}</p>
                                                            <small class="mb-1 fw-normal">Sugar</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->websnacks->macro->fat!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->websnacks->macro->fat}}</p>
                                                            <small class="mb-1 fw-normal">Fat</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->websnacks->macro->iron!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->websnacks->macro->iron}}</p>
                                                            <small class="mb-1 fw-normal">Iron</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->websnacks->macro->mag!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->websnacks->macro->mag}}</p>
                                                            <small class="mb-1 fw-normal">Magnesium</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->websnacks->macro->sodium!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->websnacks->macro->sodium}}</p>
                                                            <small class="mb-1 fw-normal">Sodium</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->websnacks->macro->copper!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->websnacks->macro->copper}}</p>
                                                            <small class="mb-1 fw-normal">Copper</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->websnacks->macro->potasium!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->websnacks->macro->potasium}}</p>
                                                            <small class="mb-1 fw-normal">Potasium</small>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                    @else
                                                    <div style="height: 70px;"></div>
                                                    @endif
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="text-primary fw-bolder me-2">Day {{$menulist->day}} (Snacks)</span>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                        @if(str_contains($input['type'], 'Dinner'))
                                        @if(isset($menulist['webdinner']))
                                        <div class="col active">
                                            <div class="card card-white dish-card profile-img mb-0">
                                                <div class="profile-img21">
                                                    <img src="{{asset($menulist->webdinner->image)}}"
                                                    onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                                    alt="{{$menulist->webdinner->name}}"
                                                        class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom">
                                                    <img src="{{asset($menulist->webdinner->image)}}"
                                                    onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`"
                                                    alt="{{$menulist->webdinner->name}}"
                                                        class="img-fluid rounded-pill avatar-170 hover-image" data-iq-gsap="onStart" data-iq-opacity="0"
                                                        data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                                        data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                                </div>
                                                <div class="card-body menu-image">

                                                    <h6 class="heading-title fw-bolder mt-4 mb-0 oneLiner" >{{$menulist->webdinner->name}}</h6>

                                                    <div class="card-rating stars-ratings">

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <svg width="18" viewBox="0 0 30 30" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </div>
                                                    @if(isset($menulist->webdinner->macro))
                                                    <ul class="d-flex mb-0 text-center " style="padding-left: 0px;height: 70px;">
                                                        @if($menulist->webdinner->macro->calories!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webdinner->macro->calories}}</p>
                                                            <small class="mb-1 fw-normal">Calories</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webdinner->macro->carbs!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webdinner->macro->carbs}}</p>
                                                            <small class="mb-1 fw-normal">Carbs</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webdinner->macro->sugar!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webdinner->macro->sugar}}</p>
                                                            <small class="mb-1 fw-normal">Sugar</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webdinner->macro->fat!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webdinner->macro->fat}}</p>
                                                            <small class="mb-1 fw-normal">Fat</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webdinner->macro->iron!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webdinner->macro->iron}}</p>
                                                            <small class="mb-1 fw-normal">Iron</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webdinner->macro->mag!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webdinner->macro->mag}}</p>
                                                            <small class="mb-1 fw-normal">Magnesium</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webdinner->macro->sodium!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webdinner->macro->sodium}}</p>
                                                            <small class="mb-1 fw-normal">Sodium</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webdinner->macro->copper!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webdinner->macro->copper}}</p>
                                                            <small class="mb-1 fw-normal">Copper</small>
                                                        </li>
                                                        @endif
                                                        @if($menulist->webdinner->macro->potasium!=0)
                                                        <li class="badge text-primary py-1 me-1 col-3">
                                                            <p class="mb-3 mt-2">{{$menulist->webdinner->macro->potasium}}</p>
                                                            <small class="mb-1 fw-normal">Potasium</small>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                    @else
                                                    <div style="height: 70px;"></div>
                                                    @endif
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="text-primary fw-bolder me-2">Day {{$menulist->day}} (Dinner)</span>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
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