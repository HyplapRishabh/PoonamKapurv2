


<!doctype html>
<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Poonamkapur.com | Online Diet Food & Many More in Mumbai</title>
      
      @include('web.weblayout.headlayout')
    </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
  
  @include('web.weblayout.loader')
      <div class="wrapper">
      <section class="container-fluid bg-circle" id="auth-login">
         <div class="row align-items-center">            
            <div class="col-md-12 col-lg-7 col-xl-4">
               <a href="index-2.html">
                  <img src="{{url('webassets/images/logo.png')}}" class="img-fluid logo-img ms-5" alt="img2">
               </a>
               <div class="card-body text-center">
                     
                  @if($trxdtl->trxStatus=='success')          
                     <svg width="86" viewBox="0 0 86 91" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M44.4591 8.17851C44.5206 6.49584 43.205 5.07059 41.5222 5.12837C33.9539 5.38825 26.5686 7.64133 20.1257 11.6841C12.8201 16.2681 7.06402 22.9412 3.60569 30.836C0.147358 38.7307 -0.853289 47.482 0.733814 55.9523C2.32092 64.4225 6.42237 72.2201 12.5051 78.3314C18.5877 84.4426 26.3703 88.585 34.8413 90.22C43.3122 91.8551 52.0797 90.9072 60.0041 87.4995C67.9285 84.0918 74.6433 78.382 79.2758 71.1122C83.36 64.7029 85.6591 57.3423 85.9649 49.7871C86.0331 48.1028 84.6141 46.7774 82.9292 46.829V46.829C81.2442 46.8806 79.9333 48.2905 79.8453 49.974C79.5143 56.3045 77.5522 62.4616 74.1259 67.8384C70.1511 74.0762 64.3895 78.9754 57.5901 81.8993C50.7907 84.8232 43.2679 85.6365 35.9995 84.2336C28.7312 82.8307 22.0534 79.2764 16.8343 74.0327C11.6151 68.789 8.09591 62.0984 6.73412 54.8306C5.37233 47.5629 6.23092 40.054 9.19829 33.28C12.1657 26.506 17.1046 20.7803 23.3731 16.847C28.7786 13.4551 34.9573 11.5315 41.3 11.2393C42.9818 11.1619 44.3975 9.86097 44.4591 8.17851V8.17851Z" fill="#EA6A12"/>
                        <path d="M40.0136 54.5643L76.8701 18.1495C78.1796 16.8557 80.2738 16.8169 81.6303 18.0614V18.0614C83.0887 19.3993 83.1259 21.687 81.7118 23.0717L40.0135 63.9056L21.8386 46.082C20.6265 44.8933 20.6169 42.9441 21.8173 41.7435V41.7435C22.9764 40.5842 24.8443 40.5472 26.0483 41.6598L40.0136 54.5643Z" fill="#EA6A12"/>
                     </svg>       
                     <h2 class="mt-3 mb-0 ">Success !</h2>
                     @if($trxdtl->trxFor=='consultation')
                        <p class="cnf-mail mb-1">Your consultation has been booked successfully your order id is #PKHK_{{$trxdtl->payutxnid}}, <br>
                        Our executive will call you shortly,<br>
                        <div class="d-inline-block w-100">
                           <a href="{{url('/')}}" class="btn btn-primary mt-3">Home</a>
                        </div>
                     @else
                        <p class="cnf-mail mb-1">Your order has been placed Order Id is #PKHK_{{$trxdtl->payutxnid}}, <br>
                        Our executive will call you shortly,<br>
                        Please check order details section for order status.</p>
                        <div class="d-inline-block w-100">
                           <a href="{{url('/app/orderdetails')}}" class="btn btn-primary mt-3">Order Details</a>
                           <a href="{{url('/')}}" class="btn btn-primary mt-3">Home</a>
                        </div>
                     @endif
                     
                  @elseif($trxdtl->trxStatus=='failure')  
                     <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                    <use xlink:href="#exclamation-triangle-fill01"></use>
                              </svg>
                     <h2 class="mt-3 mb-0 ">Failed !</h2>
                        <p class="cnf-mail mb-1">Your order has been failed due to {{$trxdtl->reason}} <br>
                        <div class="d-inline-block w-100">
                           @if($trxdtl->trxFor=='alacart')
                              <a href="{{url('/app/alacartcheckout')}}" class="btn btn-primary mt-3">Place again</a>
                           @elseif($trxdtl->trxFor=='consultation')
                              <a href="{{url('/app/consultation')}}" class="btn btn-primary mt-3">Place again</a>
                           @elseif($trxdtl->trxFor=='subscription')
                              <a href="{{url('/app/goal/')}}/{{Str::slug($packagedtl->goal->name)}}?goal={{$packagedtl->goalId}}&pkgId={{$packagedtl->id}}&meal={{$packagedtl->mealtype->name}}" class="btn btn-primary mt-3">Place again</a>
                           @endif
                           <a href="{{url('/')}}" class="btn btn-primary mt-3">Home</a>
                        </div>
                  @endif
               </div> 
            </div>
            <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
               <div>
                  <img src="{{url('webassets/images/auth/01.png')}}" class="hover-img rounded-circle first-img" alt="images">
                  <img src="{{url('webassets/images/auth/02.png')}}" class="hover-img rounded-circle second-img" alt="images">
                  <img src="{{url('webassets/images/auth/03.png')}}" class="hover-img rounded-circle third-img" alt="images">
                  <img src="{{url('webassets/images/auth/04.png')}}" class="hover-img rounded-circle fourth-img" alt="images">
                  <img src="{{url('webassets/images/auth/05.png')}}" class="hover-img rounded-circle fifth-img" alt="images">
                  <img src="{{url('webassets/images/auth/06.png')}}" class="hover-img rounded-circle six-img" alt="images">
                  <img src="{{url('webassets/images/auth/01.png')}}" class="hover-img rounded-circle seventh-img" alt="images">
                  <img src="{{url('webassets/images/auth/02.png')}}" class="hover-img rounded-circle eight-img" alt="images">
               </div>
            </div>
         </div>
      </section>
      </div>
      @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')
</body>
</html>