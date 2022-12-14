<!doctype html>
<html lang="en" dir="ltr">

<!-- restaurant-dashboard.html   08:53:07 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poonamkapur.com | {{$goaldtl->name}}</title>
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

        .cat {
            margin: 4px;
            border-radius: 4px;
            border: 1px solid #EA6A12;
            overflow: hidden;
            float: left;
        }

        .cat label {
            float: left;
            line-height: 3.0em;
            width: 8.0em;
            height: 3.0em;
        }

        .cat label span {
            text-align: center;
            display: block;
        }

        .cat label input {
            position: absolute;
            display: none;
            color: #000 !important;
        }

        /* selects all of the text within the input element and changes the color of the text */
        .cat label input+span {
            color: #000;
        }


        /* This will declare how a selected input will look giving generic properties */
        .cat input:checked+span {
            color: #ffffff;
            text-shadow: 0 0 6px rgba(0, 0, 0, 0.8);
        }


        /*
This following statements selects each category individually that contains an input element that is a checkbox and is checked (or selected) and chabges the background color of the span element.
*/

        .action input:checked+span {
            background-color: #EA6A12;
        }
    </style>
</head>

<body class="bodycss" onload="clickmt()">
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
                <div class="col-lg-9">
                    <div class="card mb-3" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".4" data-iq-trigger="scroll" data-iq-ease="none">
                        <div class="card-body">
                            <a href="{{url('/')}}" class="">Home /</a>
                            <a href="{{url('/')}}" class="">{{$goaldtl->name}}/</a>
                            <a href="#" class="">{{$goaldtl->name}}</a>
                            <div class="mt-2 mb-3">
                                <ul class="nav nav-tabs mb-4 nav-justified" id="myTabs" role="tablist">
                                    @foreach($goalpkg as $pkgdtl)
                                    <li class="nav-item" role="presentation" onclick="changemealtype('{{$pkgdtl->mealtype->name}}')">
                                        <a href="#pkg{{$pkgdtl['id']}}" class="nav-link {{ $input['pkgId']==$pkgdtl->id ? 'active' : '' }}" id="pkg{{$pkgdtl['id']}}-tab" data-bs-toggle="tab" data-bs-target="#pkg{{$pkgdtl['id']}}" role="tab" aria-selected="true">
                                            <div class="d-flex align-items-center mb-3">
                                                <svg class="bg-primary rounded-circle me-3" width="10%" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M46.875 25C43.45 25 40.625 28.8 40.625 33.5C40.625 37.2 42.375 40.275 44.8 41.45L45 41.55V57.5H48.75V41.55L48.95 41.475C51.375 40.3 53.125 37.225 53.125 33.525C53.125 28.825 50.325 25 46.875 25ZM36.25 25C35.575 25 35 25.55 35 26.25V32.5H33.125V26.25C33.125 25.55 32.575 25 31.875 25C31.175 25 30.625 25.55 30.625 26.25V32.5H28.75V26.25C28.75 25.55 28.2 25 27.5 25C26.8 25 26.25 25.55 26.25 26.25V35.75C26.25 38.075 27.85 40.025 30 40.575V57.5H33.75V40.575C35.9 40.025 37.5 38.075 37.5 35.75V26.25C37.5 25.55 36.95 25 36.25 25ZM60 20H20V60H60V20ZM60 15C62.75 15 65 17.25 65 20V60C65 62.75 62.75 65 60 65H20C17.25 65 15 62.75 15 60V20C15 17.25 17.25 15 20 15H60Z" fill="white" />
                                                </svg>
                                                <!-- <span class="text-dark">{{$pkgdtl->mealtype->name}}</span> -->
                                                <span class="text-dark">{{$pkgdtl->UID}}</span>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-3 iq-fetch">
                                <div class="cat action">
                                    <label>
                                        <input onclick="clickmt()" checked name="mtck" type="checkbox" value="BreakFast"><span>Breakfast</span>
                                    </label>
                                </div>

                                <div class="cat action">
                                    <label>
                                        <input onclick="clickmt()" checked name="mtck" type="checkbox" value="Lunch"><span>Lunch</span>
                                    </label>
                                </div>

                                <div class="cat action">
                                    <label>
                                        <input onclick="clickmt()" name="mtck" type="checkbox" value="Snack"><span>Snacks</span>
                                    </label>
                                </div>

                                <div class="cat action">
                                    <label>
                                        <input onclick="clickmt()" checked name="mtck" type="checkbox" value="Dinner"><span>Dinner</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-5">
                    <div class="card dish-card profile-img3 " data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".5" data-iq-trigger="scroll" data-iq-ease="none">
                        <div class="card-body">
                            <div class="">
                                <div class="profile-img40 ">
                                    <img src="{{asset($goaldtl->image)}}" onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" class="img-fluid rounded-pill" alt="image">
                                </div>
                                <div class="profile-img52" style="padding: 5px; margin-top:80px!important; height: 100px; overflow-y: scroll;">
                                    {{$goaldtl->description}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="pkglist">


            </div>

        </div>
        @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')

    <script>
        var totalmeal = 0;

        function changemealtype(mealtype) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('meal', mealtype);
            let stateObj = {
                id: "100"
            };
            window.history.replaceState(stateObj, "Page 3", "?" + urlParams);
            clickmt();
        }

        function clickmt() {
            yourArray = [];
            $("input:checkbox[name=mtck]:checked").each(function() {
                yourArray.push($(this).val());
            });
            console.log(yourArray);
            totalmeal = yourArray.length;


            loadnewprod(totalmeal);

        }



        function loadnewprod(selectedType) {
            console.log(selectedType);

            winsearch = window.location.search;
            console.log(winsearch);
            $.ajax({
                url: '/app/getgoalpkg/rh' + winsearch,
                type: "get",
                success: function(data) {
                    console.log(data);
                    document.getElementById('pkglist').innerHTML = '<div class="bkgloader"><div class="loader123"></div>';

                    if (data['status'] == "success") {
                        str = "";
                        console.log(data['pkgdtl']['lPrice']);
                        data['days'].forEach(element => {
                            onemealprice = data['pkgdtl']['lPrice'];
                            if (element == 3) {
                                onemealprice = data['pkgdtl']['lPrice'];
                            } else if (element == 15) {
                                onemealprice = (data['pkgdtl']['lPrice'] - (data['pkgdtl']['lPrice'] * 5) / 100);
                            } else if (element == 30) {
                                onemealprice = (data['pkgdtl']['lPrice'] - (data['pkgdtl']['lPrice'] * 10) / 100);
                            } else if (element == 60) {
                                onemealprice = (data['pkgdtl']['lPrice'] - (data['pkgdtl']['lPrice'] * 15) / 100);
                            }


                            str += '<div class="col-lg-3 col-sm-12 col-md-3">\
                                        <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">\
                                            <div class="card-body">\
                                                <div class="d-flex justify-content-between pb-3 ">\
                                                    <div>\
                                                        <div class="heading-title">\
                                                            <h4 class="mt-2" style="text-align: center;">Package For ' + element + ' Days</h4>\
                                                            <p class="mt-2">Price Per Meal : <strong style="font-size: 22px;">' + onemealprice + ' Rs</strong></p>\
                                                            <p class="mt-2">Total Price For ' + element + ' Days : <strong style="font-size: 20px;">  ' + Math.round(onemealprice * element * totalmeal) + '/- </strong></p>\
                                                        </div>\
                                                        <li>' + element * totalmeal + ' dishes</li>\
                                                        <li>Different Menu Everyday</li>\
                                                        <li>' + data['pkgdtl']['description'] + '</li>\
                                                    </div>\
                                                </div>\
                                                <div class="iq-share-btn" style="text-align: center;">\
                                                    <button onclick="menu(' + element + ',' + data['pkgdtl']['id'] + ')"  class="btn btn-primary rounded-pill mt-3 me-2 redirectButtons" style="width: 100%;">\
                                                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />\
                                                        </svg> Check Menu</button>\
                                                    <button onclick="subscribe(' + element + ',' + data['pkgdtl']['id'] + ',' + onemealprice + ')" class="btn btn-primary rounded-pill mt-3 me-2 redirectButtons" style="width: 100%;">\
                                                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />\
                                                        </svg> Subscribe</button>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>'
                        });
                        document.getElementById('pkglist').innerHTML = str;
                        if (selectedType == 0) {
                            // disable all button with classname
                            document.querySelectorAll(".redirectButtons").forEach(e => e.disabled = true)
                        } else {
                            document.querySelectorAll(".redirectButtons").forEach(e => e.disabled = false)
                        }
                    } else {

                    }
                }
            });


        }

        function subscribe(days, pkgid, onemeal) {
            yourArray = [];
            $("input:checkbox[name=mtck]:checked").each(function() {
                yourArray.push($(this).val());
            });
            onemeal = onemeal * 23;
            href = "/app/packagesubscription/" + pkgid + "?days=" + days + "&type=" + yourArray.toString() + "&ps=" + onemeal;
            window.location.href = href;
        }

        function menu(days, pkgid) {
            yourArray = [];
            $("input:checkbox[name=mtck]:checked").each(function() {
                yourArray.push($(this).val());
            });
            console.log(yourArray)
            // return false;
            href = "/app/packagemenu/" + pkgid + "?days=" + days + "&type=" + yourArray.toString();
            window.location.href = href;
        }
    </script>
</body>

</html>