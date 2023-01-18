<?php

namespace App\Http\Middleware;

use App\Models\consultation;
use App\Models\Enquirybulk;
use App\Models\Enquiryfranchise;
use Closure;
use Illuminate\Http\Request;

class AdminStatCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bulkEnquiryCount = Enquirybulk::count();
        $franchiseEnquiryCount = Enquiryfranchise::count();
        $consultationCount = consultation::where('status','Pending')->count();

        config([
            'bulkEnquiryCount' => $bulkEnquiryCount,
            'franchiseEnquiryCount' => $franchiseEnquiryCount,
            'consultationCount' => $consultationCount,
        ]);

        return $next($request);
    }
}
