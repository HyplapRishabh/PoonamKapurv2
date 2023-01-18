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
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="d-flex justify-content-center mb-0">
                                <div class="card-body text-center">
                                    <a href="{{url('/')}}">
                                        <img src="{{ asset('webassets/images/logo.png')}}" class="img-fluid logo-img mb-4" alt="img3">
                                    </a>
                                    <h2 class="mb-2 text-center">Reset Password</h2>
                                    <p class=" text-center">Enter your new password.</p>
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
                                    <form action="{{url('/app/confirmresetpass')}}" method="post">
                                        @csrf
                                        <div class="row text-start">
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input type="hidden" name="hiddenUserId" value="{{$resetPassDetails->userId}}">
                                                    <label for="email" class="form-label">New Password</label>
                                                    <input type="text" class="form-control form-control-sm" name='password' id="uemail" aria-describedby="email" placeholder=" ">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
                    <div>
                        <img src="{{ asset('webassets/images/auth/01.png')}}" class="hover-img rounded-circle first-img" alt="images">
                        <img src="{{ asset('webassets/images/auth/02.png')}}" class="hover-img rounded-circle second-img" alt="images">
                        <img src="{{ asset('webassets/images/auth/03.png')}}" class="hover-img rounded-circle third-img" alt="images">
                        <img src="{{ asset('webassets/images/auth/04.png')}}" class="hover-img rounded-circle fourth-img" alt="images">
                        <img src="{{ asset('webassets/images/auth/05.png')}}" class="hover-img rounded-circle fifth-img" alt="images">
                        <img src="{{ asset('webassets/images/auth/06.png')}}" class="hover-img rounded-circle six-img" alt="images">
                        <img src="{{ asset('webassets/images/auth/01.png')}}" class="hover-img rounded-circle seventh-img" alt="images">
                        <img src="{{ asset('webassets/images/auth/02.png')}}" class="hover-img rounded-circle eight-img" alt="images">
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('web.weblayout.footerscript')
    @include('web.weblayout.webscript')

    <script>
        function checkresetpass(event) {
            event.preventDefault();
            document.getElementById('loginuemail').innerHTML = '';
            document.getElementById('showerror').style.display = 'none';
            document.getElementById('showsuccess').style.display = 'none';

            var emailidval = document.getElementById('uemail').value;

            if (emailidval) {
                logindata = {
                    emailId: emailidval
                }
                $.ajax({
                    url: '/app/checkresetpass',
                    type: "post",
                    data: logindata,
                    success: function(data) {
                        if (data['status'] != 200) {
                            document.getElementById('showerror').style.display = 'block';
                            document.getElementById('mainerror').innerHTML = data['message'];
                        } else if (data['status'] == 200) {
                            document.getElementById('showsuccess').style.display = 'block';
                            document.getElementById('mainsuccess').innerHTML = data['message'];

                            setTimeout(function() {
                                window.location = document.referrer;
                            }, 4000);
                        }
                    }
                });
            } else {
                document.getElementById('loginuemail').innerHTML = 'Please enter valid Email Id to continue';
            }


        }
    </script>
</body>

</html>