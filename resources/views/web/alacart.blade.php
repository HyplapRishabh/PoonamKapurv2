<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poonamkapur.com | Online Diet Food & Many More in Mumbai</title>
    @include('web.weblayout.headlayout')

    <style>
        .bkgcategory
        {

            background-image:url("{{url('webassets/images/layouts/01.png')}}");
            background-repeat: no-repeat; 
            
            background-size: cover;background-position: center right;
        }
        .bodycss
        {
            background-image:url("{{url('webassets/images/dashboard.png')}}"); 
            background-attachment: fixed; 
            background-size: cover;
        }
        .txtwrp
        {
            /* display: -webkit-box; */
            /* -webkit-box-orient: vertical; */
            /* -webkit-line-clamp: 1; */
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
            white-space: nowrap;
            font-size:1rem;
            line-height:1;
            -o-text-overflow:ellipsis;
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
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card " data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                        data-iq-duration=".6" data-iq-delay=".8" data-iq-trigger="scroll" data-iq-ease="none">
                        <div class="hero-image p-3 bkgcategory">
                            <div class="card-body">
                                <div class="row banner-container">
                                    <div class="col-lg-12 banner-item">
                                        <span class="text-primary">
                                            <svg width="20" height="15" viewBox="0 0 128 128" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M94.5186 21.8107C96.9586 20.6307 98.6486 18.1407 98.6486 15.2507C98.6486 13.3199 97.8816 11.4682 96.5163 10.103C95.1511 8.7377 93.2994 7.9707 91.3686 7.9707C89.4378 7.9707 87.5861 8.7377 86.2209 10.103C84.8556 11.4682 84.0886 13.3199 84.0886 15.2507C84.0886 18.1807 85.8186 20.6907 88.3086 21.8507C85.4286 37.4507 81.0086 49.0607 64.5586 51.5407C64.5586 51.5407 68.9886 73.6907 89.7086 73.6907C110.429 73.6907 112.529 51.7607 112.529 51.7607C95.7186 52.6207 94.2986 31.4907 94.5186 21.8107V21.8107Z"
                                                    fill="#F19534" />
                                                <path
                                                    d="M34.7383 21.8107C32.2983 20.6307 30.6083 18.1407 30.6083 15.2507C30.6083 13.3199 31.3753 11.4682 32.7405 10.103C34.1058 8.7377 35.9575 7.9707 37.8883 7.9707C39.8191 7.9707 41.6708 8.7377 43.036 10.103C44.4013 11.4682 45.1683 13.3199 45.1683 15.2507C45.1683 18.1807 43.4383 20.6907 40.9483 21.8507C43.8283 37.4507 48.2483 49.0607 64.6983 51.5407C64.6983 51.5407 60.2683 73.6907 39.5483 73.6907C18.8283 73.6907 16.7383 51.7707 16.7383 51.7707C33.5383 52.6207 34.9583 31.4907 34.7383 21.8107V21.8107Z"
                                                    fill="#F19534" />
                                                <path
                                                    d="M89.4297 73.6891C89.5197 73.6891 89.6097 73.6991 89.6997 73.6991C95.4097 73.6991 99.6997 72.0291 102.92 69.6191L89.4297 73.6891Z"
                                                    fill="#FFCA28" />
                                                <path
                                                    d="M119.242 16.8609C115.912 16.4109 112.732 19.5809 112.152 23.9209C111.792 26.6309 112.522 29.1609 113.932 30.7909L111.532 40.7409C111.532 40.7409 107.862 64.2509 89.3215 68.8909C74.5015 72.6009 69.1315 45.4709 67.8315 37.0909C70.6515 35.6909 72.6015 32.7909 72.6015 29.4209C72.6015 24.6909 68.7715 20.8609 64.0415 20.8609C59.3115 20.8609 55.4815 24.6909 55.4815 29.4209C55.4815 32.8109 57.4615 35.7409 60.3315 37.1209C59.3015 45.3909 54.7615 71.6209 38.7615 68.8809C22.5215 66.0909 15.4315 38.7409 13.7915 31.3009C15.7415 29.7009 16.8315 26.8809 16.4315 23.8509C15.8515 19.5009 12.4115 16.3809 8.75151 16.8709C5.09151 17.3609 2.60151 21.2809 3.18151 25.6209C3.60151 28.7809 5.54151 31.2909 7.97151 32.2409L20.6915 111.271C20.6915 111.271 31.7915 120.041 64.0415 120.041C96.2915 120.041 107.392 111.271 107.392 111.271L120.142 32.0309C122.202 30.9509 123.822 28.5209 124.222 25.5409C124.812 21.1909 122.582 17.3109 119.242 16.8609V16.8609Z"
                                                    fill="#FFCA28" />
                                                <path
                                                    d="M64.4392 99.9095C69.8185 99.9095 74.1792 94.7115 74.1792 88.2995C74.1792 81.8874 69.8185 76.6895 64.4392 76.6895C59.06 76.6895 54.6992 81.8874 54.6992 88.2995C54.6992 94.7115 59.06 99.9095 64.4392 99.9095Z"
                                                    fill="#26A69A" />
                                                <path
                                                    d="M64.4394 79.5598C64.8194 79.9798 65.1594 80.7498 64.4394 82.2498C63.7194 83.7498 59.8394 85.7798 59.1294 86.1898C58.4194 86.6098 57.9494 86.4198 57.7294 86.2498C56.6794 85.4098 57.0794 83.5098 57.7594 82.3498C59.2194 79.8398 62.3094 77.2498 64.4394 79.5598V79.5598Z"
                                                    fill="#69F0AE" />
                                                <path
                                                    d="M63.7186 92.6299C62.6186 93.1599 59.0086 94.7699 60.1986 96.6799C60.8986 97.8099 62.3486 98.2899 63.6786 98.3499C65.0086 98.4099 66.3186 97.9899 67.4986 97.3799C73.0986 94.4799 73.5486 86.8599 72.4586 86.2799C71.3386 85.6799 70.5786 87.2299 69.9986 87.8899C68.235 89.865 66.1015 91.4753 63.7186 92.6299V92.6299Z"
                                                    fill="#00796B" />
                                                <path
                                                    d="M118.09 78.8003C119.65 70.1703 113.85 68.0103 113.85 68.0103C113.85 68.0103 110.11 67.3303 108.35 77.0403C106.59 86.7403 110.33 87.4203 110.33 87.4203C110.33 87.4203 116.52 87.4303 118.09 78.8003V78.8003Z"
                                                    fill="#26A69A" />
                                                <path
                                                    d="M115.511 70.96C116.871 72.78 115.261 75.47 112.651 77.26C111.881 77.79 110.861 77.59 110.711 77.15C110.291 75.89 110.471 74.46 111.031 73.25C112.691 69.62 114.821 70.04 115.511 70.96V70.96Z"
                                                    fill="#69F0AE" />
                                                <path
                                                    d="M9.76138 79.06C8.19138 70.44 14.0014 68.27 14.0014 68.27C14.0014 68.27 17.7414 67.59 19.5014 77.3C21.2614 87 17.5214 87.68 17.5214 87.68C17.5214 87.68 11.3214 87.69 9.76138 79.06V79.06Z"
                                                    fill="#26A69A" />
                                                <path
                                                    d="M15.7805 71.1993C17.1205 72.1993 16.5705 73.5093 15.5605 74.4193C14.4105 75.4693 13.5305 76.6193 12.5505 77.8093C12.4005 77.9893 12.2305 78.1893 11.9905 78.2393C11.5305 78.3393 11.1605 77.8693 11.0105 77.4193C10.5805 76.1593 10.6605 74.6793 11.3005 73.5193C13.1205 70.2093 15.2605 70.8093 15.7805 71.1993V71.1993Z"
                                                    fill="#69F0AE" />
                                                <path
                                                    d="M99.9895 87.1599C99.2995 91.0899 96.1495 93.8199 92.9395 93.2599C89.7295 92.6999 89.2895 89.3499 89.9795 85.4199C90.6695 81.4899 92.2195 78.4799 95.4195 79.0399C98.6295 79.5999 100.679 83.2399 99.9895 87.1599V87.1599Z"
                                                    fill="#F44336" />
                                                <path
                                                    d="M30.431 87.1599C31.121 91.0899 34.271 93.8199 37.481 93.2599C40.691 92.6999 41.131 89.3499 40.441 85.4199C39.751 81.4899 38.201 78.4799 35.001 79.0399C31.801 79.5999 29.751 83.2399 30.431 87.1599Z"
                                                    fill="#F44336" />
                                                <path
                                                    d="M35.0795 84.5403C34.3495 85.3603 32.5695 87.0103 31.9395 85.7503C31.0795 84.0303 32.2695 81.4303 33.6295 80.5703C34.9895 79.7103 36.0995 80.3903 36.2895 81.1603C36.5195 82.1403 35.7295 83.8003 35.0795 84.5403V84.5403Z"
                                                    fill="#FFA8A4" />
                                                <path
                                                    d="M91.9807 87.0505C90.9907 86.9005 90.8807 83.4905 93.5407 80.8105C94.8107 79.5305 96.6307 81.0505 96.1707 83.1005C95.7307 85.0505 93.7907 87.3305 91.9807 87.0505V87.0505Z"
                                                    fill="#FFA8A4" />
                                                <path
                                                    d="M109.151 98.2109C103.161 101.211 89.4208 109.201 64.0508 109.201C38.6808 109.201 24.9408 101.211 18.9508 98.2109C18.9508 98.2109 16.8008 99.3609 16.8008 100.561V109.771C16.8008 111.001 17.4508 112.131 18.5108 112.761C23.1908 115.521 37.4508 122.041 64.0608 122.041C90.6708 122.041 104.931 115.521 109.611 112.761C110.131 112.454 110.562 112.017 110.862 111.493C111.162 110.968 111.32 110.375 111.321 109.771V100.561C111.301 99.3609 109.151 98.2109 109.151 98.2109V98.2109Z"
                                                    fill="#FFCA28" />
                                                <path
                                                    d="M39.6002 110.84C42.4002 111.39 43.2502 111.63 43.0602 113.19C42.6702 116.26 36.3002 115.53 32.5302 114.54C24.7402 112.49 23.1602 110.33 23.1602 108.4C23.1602 106.63 24.5202 106.42 26.6202 107.16C29.1302 108.05 33.0102 109.55 39.6002 110.84V110.84Z"
                                                    fill="#FFF59D" />
                                                <path
                                                    d="M109.149 100.23C109.149 100.23 92.5792 109.61 64.0492 109.61C35.5192 109.61 18.9492 100.23 18.9492 100.23"
                                                    stroke="#F19534" stroke-width="4" stroke-miterlimit="10"
                                                    stroke-linecap="round" />
                                                <path
                                                    d="M26.9699 49.5704C32.2899 45.7704 35.1499 38.9604 35.3999 28.1204C35.4199 27.1404 35.6999 26.8504 36.2299 26.7904C37.0799 26.7004 37.2199 27.4704 37.2099 28.0204C36.9699 39.7204 35.4799 47.0304 29.5799 51.1504C29.2899 51.3504 27.2199 52.6104 26.3399 51.7404C25.2899 50.7204 26.6299 49.8104 26.9699 49.5704V49.5704Z"
                                                    fill="#FFCA28" />
                                                <path
                                                    d="M31.8383 15.5396C31.6683 13.7296 32.0883 10.4696 36.8383 8.98957C38.2283 8.55957 39.0883 9.23957 39.2483 9.76957C39.6483 11.0896 38.4883 11.6096 37.9583 11.7796C34.3083 12.9596 34.1283 14.7796 33.3783 15.9396C32.6283 17.0996 31.8983 16.0896 31.8383 15.5396V15.5396Z"
                                                    fill="#FFCA28" />
                                                <path
                                                    d="M78.2214 47.1694C83.0314 42.8994 86.2214 38.1294 88.3214 27.2694C88.5114 26.3094 88.7914 26.0494 89.3114 26.0694C90.1614 26.0894 90.2014 26.8794 90.1114 27.4194C88.3314 38.9994 86.6414 42.2994 80.7114 48.8694C80.0414 49.6094 78.4114 50.2794 77.4914 49.5094C76.6614 48.8194 77.6214 47.7094 78.2214 47.1694V47.1694Z"
                                                    fill="#FFCA28" />
                                                <path
                                                    d="M85.2993 15.6294C85.1293 13.8194 85.5493 10.5594 90.2993 9.07941C91.6893 8.64941 92.5493 9.32941 92.7093 9.85941C93.1093 11.1794 91.9493 11.6994 91.4193 11.8694C87.7693 13.0494 87.5892 14.8694 86.8392 16.0294C86.0992 17.1894 85.3593 16.1794 85.2993 15.6294V15.6294Z"
                                                    fill="#FFCA28" />
                                                <path
                                                    d="M31.5915 71.6207C19.9715 66.3507 16.5515 52.6007 14.7315 46.6307C14.4915 45.8407 14.6115 45.0907 15.4015 44.8507C16.1915 44.6107 16.6615 45.1207 16.9115 45.9107C18.2315 50.2407 23.3615 64.7007 33.9515 68.8107C34.7215 69.1107 35.9215 69.8407 35.2715 71.0907C34.8415 71.9007 33.4615 72.4707 31.5915 71.6207V71.6207Z"
                                                    fill="#FFF59D" />
                                                <path
                                                    d="M12.6801 24.63C12.1201 23.47 11.8901 22.37 8.84013 21.1C8.07013 20.78 7.56013 20.07 7.77013 19.27C7.98013 18.47 8.78013 17.87 9.94013 18.07C13.7101 18.72 14.5301 22.55 14.6901 23.88C14.8401 25.16 13.2501 25.79 12.6801 24.63V24.63Z"
                                                    fill="#FFF59D" />
                                                <path
                                                    d="M96.8701 71.6207C108.49 66.3507 111.91 52.6007 113.73 46.6307C113.97 45.8407 113.85 45.0907 113.06 44.8507C112.27 44.6107 111.8 45.1207 111.55 45.9107C110.23 50.2407 105.1 64.7007 94.5101 68.8107C93.7401 69.1107 92.5401 69.8407 93.1901 71.0907C93.6201 71.9007 95.0001 72.4707 96.8701 71.6207Z"
                                                    fill="#FFF59D" />
                                                <path
                                                    d="M115.782 24.63C116.342 23.47 116.572 22.37 119.622 21.1C120.392 20.78 120.902 20.07 120.692 19.27C120.482 18.47 119.682 17.87 118.522 18.07C114.752 18.72 113.932 22.55 113.772 23.88C113.622 25.16 115.222 25.79 115.782 24.63V24.63Z"
                                                    fill="#FFF59D" />
                                                <path
                                                    d="M59.3805 29.5491C59.9905 28.2991 61.0605 26.5891 64.5505 25.8691C65.8905 25.5891 66.2805 25.0091 66.1605 24.1291C65.9205 22.2991 63.6405 22.4291 62.4105 22.7191C58.3105 23.6791 57.4005 27.3191 57.2305 28.7591C57.0605 30.1291 58.7805 30.7991 59.3805 29.5491V29.5491Z"
                                                    fill="#FFF59D" />
                                            </svg>
                                            <small>Deal of the weekend</small>
                                        </span>
                                        <div class="banner-text pt-3">
                                            <h1 class="fw-bold mb-4">
                                                GET YOUR DIET PLAN ON US
                                            </h1>
                                        </div>
                                        <p class="mb-4">Get <span class="text-primary">Diet Meal </span>every day.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-12 col-lg-4">
                    <div class="card my-cart-card">
                        <div
                            class="card-header d-flex align-items-center justify-content-between pb-0  border-bottom-0">
                            <h4 class="list-main">My Cart</h4>
                            <svg width="19" height="19" viewBox="0 0 22 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.9909 1.50781L1.01172 21.487" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M20.9958 21.5L1 1.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="card-body">
                            <div class="my-cart-body">
                                <div class="border border-primary rounded p-3 mt-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input type="radio" name="radios" class="form-check-input"
                                                id="exampleRadio1" checked>
                                            <label class="form-check-label" for="exampleRadio1">Use Bonus Points</label>
                                        </div>
                                        <h6 class="heading-title fw-bolder text-primary">$20</h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="heading-title fw-bolder">Final</h6>
                                        <h6 class="heading-title fw-bolder text-primary">$70.49</h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center ">
                                        <h6 class="heading-title fw-bolder">Total</h6>
                                        <h6 class="heading-title fw-bolder text-primary">&#8377 500.49</h6>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-primary rounded-pill">Checkout</button>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-primary rounded-pill">You Dont Have Any Product
                                        In Your Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>

            <!-- second row for category and other menu products -->
            <div class="row">
                <div class="card-transparent bg-transparent mb-0">
                    <div class="card-header border-0  ">

                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Our categories</h3>
                            <!-- <div class="text-dark d-flex"><a href="{{url('/app/allcategory')}}"">View
                                    All</a>
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
                                @foreach($categoryall as $catinfo)
                                    <div class="swiper-slide">
                                        <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0"
                                            data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6"
                                            data-iq-trigger="scroll" data-iq-ease="none">
                                            <div class="card-body">
                                                <a href="{{url('/app/category/')}}/{{Str::slug($catinfo->name)}}?category={{Str::slug($catinfo->name)}}">
                                                    <div class="text-center iq-menu-category">
                                                        <img src="{{asset($catinfo->image)}}"  onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$catinfo->name}}"
                                                            class="img-fluid rounded-pill avatar-100 mb-3">
                                                        <p class="heading-title fw-bolder pb-4 txtwrp" >{{$catinfo->name}}</p>
                                                        <div class="category-icon pt-4">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="24" height="24" rx="12" fill="currentColor" />
                                                                <path d="M10.25 8.5L13.75 12L10.25 15.5"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </a> </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <!-- put menu here -->
                <div class="col-md-12 col-lg-12">

                    <div class="card-transparent mb-5">

                        <div class="card-header bg-transparent px-0 pt-0">
                            <div class="d-flex justify-content-between">
                                <h2>Our Menu</h2>
                                <!-- <a href="{{url('/app/alldishes')}}" class="text-dark">
                                    View All
                                    <svg width="24" height="24" class="ms-1" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" rx="12" fill="#EA6A12" />
                                        <path d="M10.25 8.5L13.75 12L10.25 15.5" stroke="white" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a> -->
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="col-xl-12 col-lg-12 dish-card-horizontal mt-2">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-4">
                                    @foreach($productdtl as $productinfo)
                                        <div class="col active">
                                            <div class="card card-white dish-card profile-img mb-0">
                                                <div class="profile-img21">
                                                <a style="all:unset" href="{{url('/app/dish/')}}/{{$productinfo->slug}}" >
                                                    <img src="{{asset($productinfo->image)}}"  onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$productinfo->name}}"
                                                        class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom"
                                                        alt="profile-image">
                                                    <img src="{{asset($productinfo->image)}}"  onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$productinfo->name}}"
                                                        class="img-fluid rounded-pill avatar-170 hover-image "
                                                        alt="profile-image" data-iq-gsap="onStart" data-iq-opacity="0"
                                                        data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                                        data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                                </a>
                                                </div>
                                                <div class="card-body menu-image">
                                                    <h6 class="heading-title fw-bolder mt-4 mb-0">
                                                    <a style="all:unset" href="{{url('/app/dish/')}}/{{$productinfo->slug}}" >
                                                        {{$productinfo->name}}
                                                    </a></h6>
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
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <span class="text-primary fw-bolder me-2">&#8377 {{$productinfo->discountedPrice}}/-</span>
                                                            <small class="text-decoration-line-through">&#8377 {{$productinfo->price}}</small>
                                                        </div>
                                                        <a onclick="displayaddon('0','{{$productinfo->id}}','{{$productinfo->mealTypeId}}')">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect class="circle-1" width="24" height="24" rx="12"
                                                                fill="currentColor" />
                                                            <rect class="circle-2" x="11.168" y="7" width="1.66667"
                                                                height="10" rx="0.833333" fill="currentColor" />
                                                            <rect class="circle-3" x="7" y="12.834" width="1.66666"
                                                                height="10" rx="0.833332" transform="rotate(-90 7 12.834)"
                                                                fill="currentColor" />
                                                        </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- menu ends here -->
            </div>
            <!-- second row for category and other menu products ends here -->

        </div>

        <!-- modal code for area location -->
        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
            Launch demo modal
            </button>
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                   <div class="modal-content">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLongTitle">Location Details</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <input type="number" class="form-control" placeholder="Enter Your Pin code">     </div>
                      <div class="modal-footer" style="text-align: center;justify-content: center;">
                         <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                         <button type="button" style="" class="btn btn-primary rounded-pill">Save changes</button>
                      </div>
                   </div>
                </div>
             </div>
        <!-- modal code ends here -->
        <!-- Footer Section Start -->
        @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')
</body>
</html>