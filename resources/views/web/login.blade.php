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
                  <p class="text-center">Sign in to stay connected.</p>
                  <div class="alert alert-danger alert-dismissible fade show" id="showerror" style="display: none;" role="alert">
                     <span><i class="far fa-life-ring"></i></span>
                     <span id="mainerror"></span>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <div class="alert alert-success alert-dismissible fade show mb-3" id="showsuccess" style="display: none;" role="alert">
                     <span><i class="fas fa-thumbs-up"></i></span>
                     <span id="mainsuccess"></span>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <form action="{{url('/checklogin')}}" method="post" onsubmit="checklogin(event)" id="myloginform">
                     @csrf
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="email" class="form-label">Email or mobile number</label>
                              <input type="text" class="form-control form-control-sm" name='useremail' id="uemail" aria-describedby="email" placeholder=" ">
                              <span id='loginuemail' class="errorshow"></span>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" class="form-control form-control-sm" id="upassword" name='userpassword' aria-describedby="password" placeholder=" ">
                              <span id='loginupassword' class="errorshow"></span>
                           </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-between">
                           <a href="{{url('/app/resetpassword')}}">Forgot Password?</a>
                        </div>
                     </div>
                     <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                     </div>

                     <p class="mt-3 text-center">
                        Don’t have an account? <a href="{{url('/app/signup')}}" class="text-underline">Click here to sign up.</a>
                     </p>
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
      function checklogin(event) {
         event.preventDefault();
         document.getElementById('loginuemail').innerHTML = '';
         document.getElementById('loginupassword').innerHTML = '';
         document.getElementById('showerror').style.display = 'none';
         document.getElementById('showsuccess').style.display = 'none';


         var oldpasswrod = document.getElementById('upassword').value;
         var emailidval = document.getElementById('uemail').value;

         if (oldpasswrod && emailidval) {
            logindata = {
               emailId: emailidval,
               passwordval: oldpasswrod
            }
            $.ajax({
               url: '/app/checklogin',
               type: "post",
               data: logindata,
               success: function(data) {
                  if (data['status'] != 200) {
                     document.getElementById('showerror').style.display = 'block';
                     document.getElementById('mainerror').innerHTML = data['message'];
                  } else if (data['status'] == 200) {
                     document.getElementById('showsuccess').style.display = 'block';
                     document.getElementById('mainsuccess').innerHTML = data['message'];

                     // window.location = document.referrer;
                     if (localStorage.getItem('url') == null) {
                        window.location = '/';
                     } else {
                        window.location = localStorage.getItem('url');
                     }
                     // window.location = localStorage.getItem('url');
                  } else if (data['status'] == 206) {
                     document.getElementById('showerror').style.display = 'block';
                     document.getElementById('mainerror').innerHTML = data['message'];
                  }



               }
            });
         } else {
            if (!oldpasswrod) {
               document.getElementById('loginupassword').innerHTML = 'Please enter password to continue';
            }
            if (!emailidval) {
               document.getElementById('loginuemail').innerHTML = 'Please enter valid Email or mobile number to continue';
            }
         }


      }
   </script>
</body>

</html>