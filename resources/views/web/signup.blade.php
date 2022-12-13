

<!doctype html>
<html lang="en" dir="ltr">
  
<!-- auth/sign-up.html   08:53:42 GMT -->
<head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Poonamkapur.com | Online Diet Food & Many More in Mumbai</title>
           
      @include('web.weblayout.headlayout')
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">

    @include('web.weblayout.loader')
    
      <div class="wrapper">
      <section class="container-fluid bg-circle-login">
         <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 col-xl-4">               
               <div class="d-flex justify-content-center mb-0">
                  <div class="card-body mt-5">
                     <a href="{{url('/')}}">
                        <img src="{{ asset('webassets/images/logo.png')}}" class="img-fluid logo-img" alt="img5">
                     </a>
                     <h2 class="mb-2 text-center">Sign Up</h2>
                     <p class="text-center">Create your  account.</p>
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
                     <form action="{{url('/checksignup')}}" method="post" onsubmit="checksignup(event)" id="checksignup">
                        @csrf
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="full-name" class="form-label">Full Name</label>
                                 <input type="text" class="form-control form-control-sm" id="full-name" name='sname' placeholder=" ">
                                 <span id='signupfull-name' class="errorshow"></span>
                                </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="email" class="form-label">Email</label>
                                 <input type="email" class="form-control form-control-sm" id="email" name='semail'  placeholder=" ">
                                 <span id='signupemail' class="errorshow"></span>
                                </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="phone" class="form-label">Phone No.</label> 
                                 <input type="text" class="form-control form-control-sm" id="phone" name='sphone' placeholder=" ">
                                 <span id='signupphone' class="errorshow"></span>
                                </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="phone" class="form-label">OTP</label> 
                                 <input type="number" class="form-control form-control-sm" id="OTP" name='OTP' placeholder=" ">
                                 <span id='signupotp' class="errorshow"></span>
                                 <a onclick="sendotp()" class="errorshow" id='otptext' style="float: right;padding: 10px;">Send OTP</a>
                                 <a class="errorshow" id='otptimer' style="float: right;padding: 10px;"></a>

                                </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="password" class="form-label">Password</label>
                                 <input type="password" class="form-control form-control-sm" id="password" name='spassword'  placeholder=" ">
                                 <span id='signuppassword' class="errorshow"></span>
                                </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="confirm-password" class="form-label">Confirm Password</label>
                                 <input type="text" class="form-control form-control-sm" id="confirm-password" name='scpassword'  placeholder=" ">
                                 
                                 <span id='signupcpassword' class="errorshow"></span>
                                </div>
                           </div>
                           <div class="col-lg-12 d-flex justify-content-center">
                              <div class="form-check mb-3">
                                 <input type="checkbox" class="form-check-input" required id="customCheck1">
                                 <label class="form-check-label" for="customCheck1">I agree with the terms of use</label>
                                </div>
                           </div>
                        </div>
                        <div class="d-flex justify-content-center">
                           <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                        <p class="mt-3 text-center">
                           Already have an Account <a href="{{url('/app/login')}}" class="text-underline">Sign In</a>
                        </p>
                     </form>
                  </div>
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

        var random ='';
        var maxTime= 30;
        function checksignup(event)
        {
            event.preventDefault();
            document.getElementById('signupemail').innerHTML='';
            document.getElementById('signupfull-name').innerHTML='';
            document.getElementById('signupphone').innerHTML='';
            document.getElementById('signuppassword').innerHTML='';
            document.getElementById('signupcpassword').innerHTML='';
            document.getElementById('signupotp').innerHTML='';
            
            document.getElementById('showerror').style.display='none';
            document.getElementById('showsuccess').style.display='none';


            var uname=document.getElementById('full-name').value;
            var uemail=document.getElementById('email').value;
            var uphone=document.getElementById('phone').value;
            var upassword=document.getElementById('password').value;
            var ucpassword=document.getElementById('confirm-password').value;
            var uOTP=document.getElementById('OTP').value;
            
            if(uname && uemail && uphone && upassword && ucpassword && uOTP)
            {
                if(uOTP==random)
                {
                    if(upassword==ucpassword)
                    {
                        signupdata={
                        uname:uname,
                        uemail:uemail,
                        uphone:uphone,
                        upassword:upassword
                        }
                        $.ajax({
                            url: '/app/checksignup',
                            type: "post",
                            data:signupdata,
                            success: function (data) 
                            {
                                if(data['status']=='emailerror')
                                {
                                    document.getElementById('signupemail').innerHTML=data['message'];
                                }
                                else if(data['status']=='phoneerror')
                                {
                                    document.getElementById('signupphone').innerHTML=data['message'];
                                }
                                else if(data['status']!=200)
                                {
                                    document.getElementById('showerror').style.display='block';
                                    document.getElementById('mainerror').innerHTML=data['message'];
                                }
                                else if(data['status']==200)
                                {
                                    document.getElementById('showsuccess').style.display='block';
                                    document.getElementById('mainsuccess').innerHTML=data['message'];
                                
                                    setTimeout(function() { window.location=document.referrer; }, 4000);
                                }
                            }
                        });
                    }   
                    else
                    {
                        document.getElementById('signupcpassword').innerHTML='Password did not matched !';
                    }
                }
                else
                {
                    document.getElementById('signupotp').innerHTML='Invalid OTP !';
                }
                
            }
            else
            {
                if(!uname)
                {
                    document.getElementById('signupfull-name').innerHTML='Please enter your name.';
                }
                if(!uemail)
                {
                    document.getElementById('signupemail').innerHTML='Please enter email Id.';
                }
                if(!uphone)
                {
                    document.getElementById('signupphone').innerHTML='Please enter mobile number.';
                }
                if(!upassword)
                {
                    document.getElementById('signuppassword').innerHTML='Enter password.';
                }
                if(!ucpassword)
                {
                    document.getElementById('signupcpassword').innerHTML='Please enter password.';
                }
                if(!uOTP)
                {
                    document.getElementById('signupotp').innerHTML='Please enter OTP.';
                }
                
            }
            

        }

        function sendotp()
        {
            var uphone=document.getElementById('phone').value;
            random = Math.floor(Math.random() * 9000 + 1000);
            if(uphone)
            {
                    signupotpdata={
                    uphone:uphone,
                    uotp:random
                    }
                    $.ajax({
                        url: '/app/signupotp',
                        type: "post",
                        data:signupotpdata,
                        success: function (data) 
                        {
                            console.log(data);
                            if(data['status']=='phoneerror')
                            {
                                document.getElementById('signupphone').innerHTML=data['message'];
                            }
                            else 
                            {
                                StartTimer();
                                document.getElementById('signupphone').innerHTML=random;
                                document.getElementById('showsuccess').style.display='block';
                                document.getElementById('mainsuccess').innerHTML=data['message'];
                            }
                        }
                    });
                
            }
            else
            {
                document.getElementById('signupphone').innerHTML='Please enter mobile number for OTP';
            }
        }

        function StartTimer()
        {
            console.log(maxTime);
            setTimeout(x =>
            {
                if(maxTime <= 0){}
                maxTime -= 1;
                if(maxTime>0){
                document.getElementById('otptext').style.display='none';
                document.getElementById('otptimer').style.display='block';
                document.getElementById('otptimer').innerHTML='00:'+maxTime;
                this.StartTimer();
                console.log(maxTime);
                }
                else{
                maxTime=30;
                document.getElementById('otptext').style.display='block';
                document.getElementById('otptimer').style.display='none';
                }
            }, 1000);
        }
    </script>
</body>
</html>