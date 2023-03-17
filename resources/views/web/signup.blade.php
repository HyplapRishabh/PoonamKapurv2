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
                            <h2 class="mb-2 text-center">Update Details</h2>
                            <p class="text-center">Let us know more about you.</p>
                            
                            <form action="{{url('app/checksignup')}}" method="post" id="checksignup">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="full-name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control form-control-sm" id="full-name" name='name' placeholder=" ">
                                            <span id='signupfull-name' class="errorshow"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control form-control-sm" id="email" name='email' placeholder=" ">
                                            <span id='signupemail' class="errorshow"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" required id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">I agree with the terms of use</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center ">
                                    <a href="/" class="btn btn-outline-primary mx-2">Do it Later</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
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
    
</body>

</html>