<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'auth','/user/*','trymod','app/checklogin','app/checkresetpass','app/checksignup','app/signupotp','app/quizsignup'
        ,'app/gethashofpayu','app/payuresponsepkhk','app/undefined','app/payuresponseconsultpkhk','app/payuwalletresponsepkhk',
        'app/paywallet'
    ];
}
