<!doctype html>
<html lang="en" dir="ltr">

<!-- auth/sign-in.html   08:53:41 GMT -->

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Poonamkapur.com | Online Diet Food & Many More in Mumbai</title>

   @include('web.weblayout.headlayout')
</head>

<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
   @include('web.weblayout.loader')
   <div class="wrapper">
      <section class="container-fluid bg-circle-login" id="auth-sign">
         <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 col-xl-4">
               <div class="card-body" style="text-align: center;">
                  <a href="{{url('/')}}">
                     <img src="{{ asset('webassets/images/logo.png')}}" class="img-fluid logo-img" alt="img4">
                  </a>
                  <h2 class="mb-2 text-center">Sign In</h2>
                  <p class="text-center">To stay connected.</p>
                  <div class="alert alert-danger alert-dismissible fade show" id="showerror" style="display: none;" role="alert">
                     <span><i class="far fa-life-ring"></i></span>
                     <span id="mainerror"></span>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <div class="alert alert-success alert-dismissible fade show mb-3" id="showsuccess" style="display: none;" role="alert">
                     <span><i class="fas fa-thumbs-up"></i></span>
                     <span id="mainsuccess">Otp sent succesfully</span>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <form action="{{url('app/checklogin')}}" method="post" id="myloginform">
                     @csrf
                     <div class="row" id="loginForm">
                        <div class="col-lg-12">
                           <div class="form-group">
                              <input type="text" maxlength="10" minlength="10" class="form-control form-control-sm" name='phone' id="phone" placeholder="Enter Phone Number">
                              <span id='phoneError' class="errorshow"></span>
                           </div>
                        </div>
                        <div class="col-lg-12" id="otpDiv" style="display: none;">
                           <div class="form-group">
                              <input type="text" maxlength="4" minlength="4" class="form-control form-control-sm" id="otp" placeholder="Enter Otp">
                              <a href="javascript:void(0)" id="otptimer" class=" text-primary" style="font-size: 12px; float: right; display: none;">00:30</a>
                              <a href="javascript:void(0)" id="otptext" class=" text-primary" onclick="sendotp()" style="font-size: 12px; float: right; display: none; ">Resend Otp</a>
                              <span id='otpError' class="errorshow"></span>
                           </div>
                        </div>
                     </div>

                     <div class="d-flex justify-content-center">
                        <button type="button" id="signIn" onclick="checkPhone()" class="btn btn-primary">Sign In</button>
                        <button type="button" id="signUp" style="display: none;" onclick="goToAddDetails()" class="btn btn-primary">Verify Otp</button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
               <img src="{{ asset('webassets/images/auth/09.png')}}" class="img-fluid sign-in-img" alt="images">
            </div>
         </div>
      </section>
   </div>
   @include('web.weblayout.footerscript')
   @include('web.weblayout.webscript')

   <script>
      var phoneError = $('#phoneError');
      var otpError = $('#otpError');
      var showerror = $('#showerror');
      var mainerror = $('#mainerror');
      var showsuccess = $('#showsuccess');
      var mainsuccess = $('#mainsuccess');
      var otpDiv = $('#otpDiv');

      var random = '';
      var maxTime = 30;


      function checkPhone() {
         var phone = $('#phone').val();
         var phoneRegex = /^[6-9]\d{9}$/;
         if (phone == '') {
            phoneError.html('Please enter phone number');
            phoneError.show();
            return false;
         } else if (!phoneRegex.test(phone)) {
            phoneError.html('Please enter valid phone number');
            phoneError.show();
            return false;
         } else {
            phoneError.hide();
            console.log(phone);
            $.ajax({
               url: "{{url('/app/checkphonenumber')}}/" + phone,

               success: function(data) {
                  console.log(data);
                  if (data.status == 201) {
                     window.location = "/login";
                  }
                  sendotp();
               },
               error: function(data) {
                  console.log('User Not Found');
                  console.log('Error:', data);
               }
            });
         }
      }

      function sendotp() {
         var uphone = document.getElementById('phone').value;
         random = Math.floor(Math.random() * 9000 + 1000);
         if (uphone) {
            signupotpdata = {
               uphone: uphone,
               uotp: random
            }
            $.ajax({
               url: '/app/sendotp/' + uphone + '/' + random,

               success: function(data) {
                  console.log(data);
                  if (data.status == 'success') {
                     otpDiv.show();
                     $('#signIn').hide();
                     $('#signUp').show();
                     showsuccess.show();
                     StartTimer();

                  } else {
                     showerror.show();
                     mainerror.html('Something went wrong');
                  }
               }
            });

         } else {
            document.getElementById('signupphone').innerHTML = 'Please enter mobile number for OTP';
         }
      }

      function StartTimer() {
         console.log(maxTime);
         setTimeout(x => {
            if (maxTime <= 0) {}
            maxTime -= 1;
            if (maxTime > 0) {
               document.getElementById('otptext').style.display = 'none';
               document.getElementById('otptimer').style.display = 'block';
               document.getElementById('otptimer').innerHTML = '00:' + maxTime;
               this.StartTimer();
               console.log(maxTime);
            } else {
               maxTime = 30;
               document.getElementById('otptext').style.display = 'block';
               document.getElementById('otptimer').style.display = 'none';
            }
         }, 1000);
      }


      function goToAddDetails() {
         if ($('#otp').val() == random) {

            $.ajax({
               url: "{{url('/app/addphonenumber')}}/" + $('#phone').val(),
               success: function(response) {
                  console.log(response);
                  if (response.status == 200) {
                     window.location = '/app/signup';
                  } else if (response.status == 201) {
                     window.location = '/'
                  } else {
                     showerror.show();
                     mainerror.html('Something went wrong');
                  }
               }
            });

         } else {
            otpError.html('Please enter valid otp');
            otpError.show();
            return false;
         }
      }
   </script>
</body>

</html>