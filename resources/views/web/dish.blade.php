<!doctype html>
<html lang="en" dir="ltr">

<!-- special-pages/dish-detail.html   08:53:10 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poonamkapur.com |{{$dishdtl->name}}</title>

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
        
    </div>


    <main class="main-content">
        <div class="position-relative">
        @include('web.weblayout.headerlayout')
        </div>
        <div class="content-inner mt-5 py-0">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-xl-8 col-sm-12">
                    <div class="card">
                        <div class="card-header border-bottom-0 pb-0">
                            <h2 class="card-title">Product Details</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-xl-5  mb-4 mt-xl-0">
                                    <img src="{{asset($dishdtl->image)}}"  onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$dishdtl->name}}" class="img-fluid rounded" style="height: 100%;">
                                </div>
                                <div class="col-lg-12 col-xl-7">
                                    <h4 class="mb-2">{{$dishdtl->name}}</h4>
                                    <p class="mb-4">{{$dishdtl->description}}</p>
                                    <input type='hidden' value="{{$dishdtl->discountedPrice}}" name="pprice" id='pprice'>
                                   @if(isset($dishmacros))
                                    <div class="mb-0">
                                        <h4 class="mb-3">Nutritional Values</h4>
                                        <div class="row row-cols-8 row-cols-lg-8 g-2 g-lg-3">
                                            <div class="col">
                                                <div class="card rounded-1">
                                                    <div class="card-body p-2 text-center">
                                                        <h6 class="mb-1 text-primary heading-title">{{$dishmacros['calories']}}</h6>
                                                        <h6 class="mb-1 heading-title">Calories</h6>
                                                        <span class="text-dark">
                                                            <small>Kcal</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                       
                                            <div class="col">
                                                <div class="card rounded-1">
                                                    <div class="card-body p-2 text-center">
                                                        <h6 class="mb-1 text-primary heading-title">{{$dishmacros['fat']}}</h6>
                                                        <h6 class="mb-1 heading-title">Fats</h6>
                                                        <span class="text-dark">
                                                            <small>gm</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card rounded-1">
                                                    <div class="card-body p-2 text-center">
                                                        <h6 class="mb-1 text-primary heading-title">{{$dishmacros['sugar']}}</h6>
                                                        <h6 class="mb-1 heading-title">Sugar</h6>
                                                        <span class="text-dark">
                                                            <small>gm</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card rounded-1">
                                                    <div class="card-body p-2 text-center">
                                                        <h6 class="mb-1 text-primary heading-title">{{$dishmacros['mag']}}</h6>
                                                        <h6 class="mb-1 heading-title">Mag</h6>
                                                        <span class="text-dark">
                                                            <small>gm</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card rounded-1">
                                                    <div class="card-body p-2 text-center">
                                                        <h6 class="mb-1 text-primary heading-title">{{$dishmacros['iron']}}</h6>
                                                        <h6 class="mb-1 heading-title">Iron</h6>
                                                        <span class="text-dark">
                                                            <small>gm</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card rounded-1">
                                                    <div class="card-body p-2 text-center">
                                                        <h6 class="mb-1 text-primary heading-title">{{$dishmacros->zinc}}</h6>
                                                        <h6 class="mb-1 heading-title">Zinc</h6>
                                                        <span class="text-dark">
                                                            <small>gm</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card rounded-1">
                                                    <div class="card-body p-2 text-center">
                                                        <h6 class="mb-1 text-primary heading-title">{{$dishmacros['sodium']}}</h6>
                                                        <h6 class="mb-1 heading-title">Sodium</h6>
                                                        <span class="text-dark">
                                                            <small>gm</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card rounded-1">
                                                    <div class="card-body p-2 text-center">
                                                        <h6 class="mb-1 text-primary heading-title">{{$dishmacros['copper']}}</h6>
                                                        <h6 class="mb-1 heading-title">Copper</h6>
                                                        <span class="text-dark">
                                                            <small>gm</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card rounded-1">
                                                    <div class="card-body p-2 text-center">
                                                        <h6 class="mb-1 text-primary heading-title">{{$dishmacros['potasium']}}</h6>
                                                        <h6 class="mb-1 heading-title">Potasium</h6>
                                                        <span class="text-dark">
                                                            <small>gm</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-2">Add Ons</h4>
                            <!-- <p class="mb-0">The world’s favourite US burger!</p> -->
                        </div>
                        <div class="card-body text-dark" style="height: 60vh; overflow-y: auto;">
                            <table class="table table-sm table-borderless">
                                <tr class="text-primary">
                                    <th>Select</th>
                                    <th>Add-on</th>
                                    <th>Price</th>
                                </tr>
                                <tbody class="p-0">
                                    @foreach($dishaddonlist as $addon)
                                    <tr>
                                        <td>
                                            <div class="d-block text-center">
                                                <input onclick="addonselect({{$addon['price']}})" class="form-check-input border-dark ms-0" value="{{$addon['id']}}" type="radio" name="dishaddonval" id="dishaddonval">
                                            </div>
                                        </td>
                                        <td>{{$addon['description']}} ({{$addon['quantity']}} {{$addon['unit']}})</td>
                                        <td>&#8377 {{$addon['price']}}</td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-primary  rounded-pill me-4">Total &#8377 <span id='productPrice'>{{$dishdtl['discountedPrice']}}</span></button>
                                <button type="button" onclick="dishaddtocart('{{$dishdtl->id}}')" class="btn btn-primary  rounded-pill ms-4">Add To Cart</button>
                            </div>
                    </div>
                </div>
              
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card-transparent bg-transparent mb-0">
                        <div class="card-header border-0 m-2 mb-5">
                            <div class="d-flex justify-content-between">
                                <h3>Similar Dishes</h3>
                                <a href="{{url('/app/category/')}}/{{Str::slug($dishdtl->category->name)}}?category={{Str::slug($dishdtl->category->name)}}" class="text-dark">View more
                                    <svg width="24" height="24" class="ms-1" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" rx="12" fill="#EA6A12" />
                                        <path d="M10.25 8.5L13.75 12L10.25 15.5" stroke="white" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                       
                            <div class="col-xl-12 col-lg-12 dish-card-horizontal mt-2">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4 ">
                                    @foreach($similarproduct as $productlist)
                                    <div class="col active" data-iq-gsap="onStart" data-iq-opacity="0"
                                        data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6"
                                        data-iq-trigger="scroll" data-iq-ease="none">
                                        <div class="card card-white dish-card profile-img mb-0">
                                            <div class="profile-img21">
                                                <a style="all:unset" href="{{url('/app/dish/')}}/{{$productlist->slug}}" >
                                                    <img src="{{asset($productlist->image)}}"  onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$productlist->name}}"
                                                    class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom">
                                                    <img src="{{asset($productlist->image)}}"  onerror="src=`{{ asset('webassets/images/greyimage.jpg')}}`" alt="{{$productlist->name}}"
                                                    class="img-fluid rounded-pill avatar-170 hover-image " data-iq-gsap="onStart" data-iq-opacity="0"
                                                    data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                                    data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                                </a>
                                                
                                            </div>
                                            <div class="card-body menu-image">
                                                <h6 class="heading-title fw-bolder mt-4 mb-0">
                                                    <a style="all:unset" href="{{url('/app/dish/')}}/{{$productlist->slug}}" >
                                                        {{$productlist->name}}
                                                    </a></h6>
                                                <p class="mt-2 mb-0 pb-4 iq-calories small">{{$productlist->category->name}}</p>
                                                <div class="d-flex justify-content-between mt-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-primary fw-bolder me-2">&#8377 {{$productlist->discountedPrice}}</span>
                                                        <small class="text-decoration-line-through">&#8377 {{$productlist->price}}</small>
                                                    </div>
                                                    <a onclick="displayaddon('0','{{$productlist->id}}','{{$productlist->mealTypeId}}')">
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
                                                    <!-- <div class="d-flex align-items-center">
                                                    <div class="number">
                                                        <span class="minus">-</span>
                                                        <input class="pminput" type="text" value="1"/>
                                                        <span class="plus">+</span>
                                                    </div>
                                                    </div> -->
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
            </div>
        </div>
        @include('web.weblayout.footerlayout')
    </main>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')
    <script>
        function addonselect(price)
        {
            var pprice=document.getElementById('pprice').value;
            document.getElementById('productPrice').innerHTML=(pprice*1+price*1);
        }

        function dishaddtocart(productId) 
        {
            if(document.querySelector('input[name="dishaddonval"]:checked'))
            {
                addonval=document.querySelector('input[name="dishaddonval"]:checked').value;
            }
            else
            {
                addonval=0;
            }
            
            console.log(productId);
            console.log(addonval);
            $.ajax({
                url: '/app/addtocart/' + productId+'/'+addonval,
                type: "get",
                success: function (data) {
                    console.log(data);
                    if (data['status'] == "success") 
                    {
                        $('#addonmodal').modal('hide');  

                        sendnotify(data['message']);
                    }
                    else if (data['status'] == "login") {
                        window.location.href = "/app/login";
                    }
                }
            });
        }
    </script>
</body>

</html>