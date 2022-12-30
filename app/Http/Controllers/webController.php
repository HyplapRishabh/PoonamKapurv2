<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Blog;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Enquiry;
use App\Models\Goal;
use App\Models\Log;
use App\Models\Mealtime;
use App\Models\Mealtype;
use App\Models\Package;
use App\Models\Packagemenu;
use App\Models\Pincode;
use App\Models\Address;
use App\Models\Wallet;
use App\Models\Product;
use App\Models\Productmacro;
use App\Models\Productreceipe;
use App\Models\Rawmaterial;
use App\Models\Review;
use App\Models\cart;
use App\Models\cartaddon;
use App\Models\Role;
use App\Models\Subcategory;
use App\Models\Testimonial;
use App\Models\transction;
use Carbon\Carbon;
use App\Models\subscriptionorder;
use App\Models\alacartorder;
use App\Models\Enquirybulk;
use App\Models\Enquiryfranchise;
use App\Models\Faq;
use App\Models\User;
use App\Models\failtransction;
use App\Models\failalacartorder;
use App\Models\failsubscriptionorder;
use Barryvdh\DomPDF\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpParser\Node\Expr\FuncCall;

class webController extends Controller
{
    function storeLog($action, $function, $data)
    {
        $log = new Log();
        $log->userId = Auth::user()->id;
        $log->action = $action;
        $log->function = $function;
        $log->data = $data;
        $log->ip = request()->ip();
        $log->save();
    }
    
    public function welcomeindex()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        
        $testimonials = Testimonial::where([['deleteId', '0'],['status','1']])->get();
        return view('web.welcomeindex', compact('categorylist', 'packagelist','goallist','testimonials'));
    }

    public function allcategory()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        $categoryall = Category::where([['deleteId', '0'],['status','1']])->get();
        return view('web.allcategory', compact('categorylist', 'packagelist','goallist','categoryall'));
    }

    public function categorydetail($catslug,Request $input)
    {
        $mealtypedtl=$input['mealtype'];
        
        if(isset($mealtypedtl))
        {
            $mealtypedtl = mealtype::where([['deleteId', '0'],['status','1']])->where('name',$mealtypedtl)->pluck('id')->first(); 
        }
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        $checktitle=$this->sanitizeStringForUrl($catslug);
        $categorydtl = Category::where([['deleteId', '0'],['status','1']])->where('name',$checktitle)->first(); 
        $mealTypes = Product::with('webmealtype')->groupBy('mealTypeId')
        ->select('categoryId','status','deleteId','mealTypeId', DB::raw('count(*) as totalmealTypeId'))
        ->where([['categoryId',$categorydtl['id']],['deleteId', '0'],['status','1']])->get();
        
        return view('web.category', compact('categorylist','goallist','packagelist','categorydtl','mealTypes','input'));
    }

    public function getcartdata()
    {
        if(Auth::user())
        {
          $cartlist=cart::with('product')->with('addoncart')->where('userID', Auth::user()->id)->get();
        }
        else
        {
          $cartlist=[];
        }

        $myresponse['cartlist']=$cartlist;
        $myresponse['status']='success';
        return $myresponse;
    }

    public function getproductfilter(Request $input)
    {
        $mealtypedtl=$input['mealtype'];
        
        if(isset($mealtypedtl))
        {
            $mealtypedtl = mealtype::where([['deleteId', '0'],['status','1']])->where('name',$mealtypedtl)->pluck('id')->first(); 
        }

        $categorydtl=$input['category'];
        
        if(isset($categorydtl))
        {
            $checktitle=$this->sanitizeStringForUrl($categorydtl);
            $categorydtl = Category::where([['deleteId', '0'],['status','1']])->where('name',$checktitle)->first(); 
        }

        $productdtl = Product::where([['categoryId',$categorydtl['id']],['deleteId', '0'],['status','1']])
        ->when($mealtypedtl, function ($q) use ($mealtypedtl) { return $q->where('mealTypeId','=',$mealtypedtl);})
        ->inRandomOrder()->get();

        $myresponse['productdtl']=$productdtl;
        $myresponse['status']='success';
        return $myresponse;
    }


// Franchise Enquiry Submission
    public function submitFranchiseEnquiry(Request $request)
    {
        $enquiry = new Enquiryfranchise();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone = $request->phone;
        $enquiry->organisationName = $request->organisation;
        $enquiry->type = $request->type;
        $enquiry->callBackTime = $request->callBackTime;
        $enquiry->message = $request->message;
        $enquiry->save();

        return redirect()->back()->with('success', 'Thank you for your enquiry. We will get back to you soon.');
    }

    // Bulk  Enquiry Submission
    public function submitBulkEnquiry(Request $request)
    {
        $enquiry = new Enquirybulk();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone = $request->phone;
        $enquiry->organisationName = $request->organisation;
        $enquiry->type = $request->type;
        $enquiry->callBackTime = $request->callBackTime;
        $enquiry->message = $request->message;
        $enquiry->save();

        return redirect()->back()->with('success', 'Thank you for your enquiry. We will get back to you soon.');
    }

    public function getgoalpkg(Request $input)
    {
        $mealtypedtlval=$input['meal'];
        
        if(isset($mealtypedtlval))
        {
            $mealtypedtl = mealtype::where([['deleteId', '0'],['status','1']])->where('name',$mealtypedtlval)->first(); 
        }

        $pkgdtl=Package::where([['deleteId', '0'],['status','1'],['goalId',$input['goal']],['mealTypeId',$mealtypedtl['id']]])->with('mealtype')->first();
    
        $myresponse['pkgdtl']=$pkgdtl;
        $myresponse['mealtypedtl']=$mealtypedtl['id'];
        $myresponse['days']=['3','15','30','60'];
        $myresponse['status']='success';
        return $myresponse;
    }
    

    public function alacart()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        $categoryall = Category::where([['deleteId', '0'],['status','1']])->get();
        $productdtl = Product::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('16')->get();

        return view('web.alacart', compact('categorylist','goallist','packagelist','categoryall','productdtl'));
    }

    
    function sanitizeStringForUrl($string)
    {
        $string = preg_replace('#-#',' ',$string);
        return $string;
    }

    function addonlist($productId,$mealId,$cartId)
    {
        $myresponse=[];
        if(Auth::user())
        {
           $cartexist=cartaddon::where('cartId',$cartId)->pluck('addonId')->first();
          $addonlist=Addon::where([['deleteId', '0'],['status','1'],['mealTypeId',$mealId],['alaCartFlag','1']])->with('mealtype')->get();

          $myresponse['status']='success';
          $myresponse['addonlist']=$addonlist;
          $myresponse['cartexist']=$cartexist;
          return $myresponse;
        }
        else
        {
          $myresponse['status']='login';
          return $myresponse;
        }
    }

    function addtocart($productId,$addonval)
    {
        $myresponse=[];
        if(Auth::user())
        {
            $cartexist=cart::where([['productId',$productId],['userID',Auth::user()->id]])->first();
            
            
            if($cartexist)
            {   
                $cart = cart::find($cartexist['id']);
                $cart->qty = $cartexist['qty']+1;
                $cart->update();
                $cartId=$cartexist['id'];
            }
            else
            {
                $dishdtl = Product::where('id',$productId)->first(); 

                $cartId=cart::insertGetId([
                    'productId' => $dishdtl['UID'],
                    'qty' => 1,
                    'userID' => Auth::user()->id,
                ]);
            }

            if($addonval!=0)
            {
                $cartexist=cartaddon::where('cartId',$cartId)->delete();
                $cartaddon=cartaddon::insertGetId([
                    'cartId' => $cartId,
                    'addonId' => $addonval,
                    'qty' => '1',
                ]);

            }

            return response()->json([
                'status' => 'success',
                'message' => 'Added to cart !',
            ]);
        }
        else
        {
          $myresponse['status']='login';
          return $myresponse;
        }
    }

    function login()
    {
        return view('web.login');
    }

    function checklogin(Request $input)
    {

        $result = User::where(['phone' => $input['emailId']])->orWhere(['email' => $input['emailId']])->first();

        if ($result) {
            if ($result->status == 1 && $result->deleteId == 0) 
            {
                if (Hash::check($input['passwordval'], $result->password)) 
                {
                    Auth::login($result);
                    $this->storeLog('Login', 'Login', Auth::user()->id);
                    return response()->json([
                        'status' => 200,
                        'message' => 'Logged In succesfully',
                    ]);
                } else {
                    Session()->flash('alert-danger', 'Incorrect Password');
                    // return redirect()->back();
                    return response()->json([
                        'status' => 201,
                        'message' => 'Incorrect Password',
                    ]);
                }
            } else if ($result->status != 1) {
                return response()->json([
                    'status' => 204,
                    'message' => 'User Not active',
                ]);
            } else if ($result->deleteId == 1) {
                return response()->json([
                    'status' => 205,
                    'message' => 'User Deleted',
                ]);
            }
        } else {

            return response()->json([
                'status' => 202,
                'message' => 'Invalid Details',
            ]);
        }
    }

    public function resetpassword()
    {
        return view('web.resetpassword');
    }

    public function checkresetpass(Request $input)
    {

        $result = User::where(['phone' => $input['emailId']])->orWhere(['email' => $input['emailId']])->first();

        if ($result) 
        {
            if ($result->status == 1 && $result->deleteId == 0) 
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Reset password link sent on E-mail.',
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 201,
                    'message' => 'Contact site admin to change your password !',
                ]);
            }
        }
        else
        {
            return response()->json([
                'status' => 202,
                'message' => "Email Id doesn't exist !",
            ]);
        }
    }

    public function signup()
    {
        return view('web.signup');
    }

    public function checksignup(Request $request)
    {

        $resultemail = User::Where(['email' => $request['uemail']])->count();
        $resultphone = User::where(['phone' => $request['uphone']])->count();

        if($resultemail)
        {
            return response()->json([
                'status' => 'emailerror',
                'message' => 'Email Id already exist !',
            ]);
        }
        else if($resultphone)
        {
            return response()->json([
                'status' => 'phoneerror',
                'message' => 'mobile number already exist !',
            ]);
        }
        else
        {
            $user = new User();
            $user->name = $request->uname;
            $user->email = $request->uemail;
            $user->phone = $request->uphone;
            $user->role = 4;
            $user->status = '1';
            $user->password = Hash::make($request->upassword);
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'Profile Created succesfully !',
            ]);
        }
    }

    public function quizsignup(Request $request)
    {

        $resultemail = User::Where(['email' => $request['quemail']])->first();

        if($resultemail)
        {
            $user = User::find($resultemail['id']); 
            $user->name = $request->quname;
            $user->weight = $request->qweight;
            $user->age = $request->qage;
            $user->height = $request->qheight;
            $user->gender = $request->qgender;
            $user->bmi = $request->BMI;
            $user->bmr = $request->BMR;
            $user->update();

            Auth::login($resultemail);
        }
        else
        {

            $userid=User::insertGetId([
                'name' => $request->quname,
                'email' => $request->quemail,
                'weight' => $request->qweight,
                'age' => $request->qage,
                'height' => $request->qheight,
                'gender' => $request->qgender,
                'bmi' => $request->BMI,
                'bmr' => $request->BMR,
                'role' => 4,
                'status' => '1',
                'password' => Hash::make($request->uemail),
            ]);
            $resultemail = User::Where(['id' => $userid])->first();

            Auth::login($resultemail);
        }

        $goallist = Goal::where([['deleteId', '0'],['status','1'],['id',$request->qgoal]])->with('package')->first();

        return response()->json([
            'status' => 200,
            'message' => '/app/goal/'.Str::slug($goallist->name, '-').'?goal='.$goallist->id.'&pkgId='.$goallist->package->id.'&meal='.$goallist->package->mealtype->name,
        ]);
    }
    
    public function signupotp(Request $input)
    {

        $resultphone = User::where(['phone' => $input['uphone']])->count();

        if($resultphone)
        {
            return response()->json([
                'status' => 'phoneerror',
                'message' => 'mobile number already exist !',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 200,
                'message' => 'OTP send successfully !',
            ]);
        }
    }

    public function viewcart()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        $productlist = Product::with('category')->where([['deleteId', '0'],['status','1']])->limit('8')->get(); 

        $cartlist=cart::with('product')->with('addoncart')->where('userID', Auth::user()->id)->get();

        return view('web.viewcart', compact('categorylist','goallist','packagelist','productlist','cartlist'));

    }

    public function dish($pname)
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        $dishdtl = Product::with('category')->where([['deleteId', '0'],['status','1']])->where('slug',$pname)->first(); 
        $dishmacros = Productmacro::where('productUId',$dishdtl['UID'])->first(); 
        $dishaddonlist=Addon::where([['deleteId', '0'],['status','1'],['mealTypeId',$dishdtl['mealTypeId']],['alaCartFlag','1']])->with('mealtype')->get();
        $similarproduct = Product::with('category')->where([['deleteId', '0'],['status','1'],['categoryId',$dishdtl['categoryId']]])->inRandomOrder()->limit('8')->get();
        return view('web.dish', compact('categorylist','goallist','packagelist','dishdtl','dishmacros','dishaddonlist','similarproduct'));
    }

    public function deletefromcart($cartid)
    {
        $cartlist=cart::where('id',$cartid)->delete();
        $cartexist=cartaddon::where('cartId',$cartid)->delete();
        $myresponse['status']='success';
        return $myresponse;
    }

    public function updatecart($type,$cartid)
    {
        
        if($type=='sub')
        {
            $cartlist=cart::where('id',$cartid)->first();
            if($cartlist['qty']-1==0)
            {
                $cartlist=cart::where('id',$cartid)->delete();
                $cartexist=cartaddon::where('cartId',$cartid)->delete();
            }
            else
            {
                $cartlist=cart::where('id',$cartid)->decrement('qty',1);
            }
            
        }
        else
        {
            $cartlist=cart::where('id',$cartid)->increment('qty',1);
        }
        
        $myresponse['status']='success';
        return $myresponse;
    }

    public function goaldetail($goal,Request $input)
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $checktitle=$this->sanitizeStringForUrl($goal);
        $goaldtl=Goal::where([['deleteId', '0'],['status','1']])->where('name',$checktitle)->first();
        $goalpkg=Package::where([['deleteId', '0'],['status','1'],['goalId',$goaldtl['id']]])->with('mealtype')->get();
 
        return view('web.goaldetail', compact('categorylist','goallist','packagelist','goaldtl','goalpkg','input'));
    }

    public function packagemenu($pkgId,Request $input)
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        $packageinfo=Package::where([['deleteId', '0'],['status','1'],['id',$pkgId]])->first();

        $menuinfo=packagemenu::where('packageUId',$packageinfo['UID'])->with('webbreakfast')->with('weblunch')->with('websnacks')->with('webdinner')->limit($input['days'])->orderBy('day')->get();
      
        return view('web.packagemenu', compact('categorylist','goallist','packageinfo','packagelist','menuinfo','input'));
    }
    
    public function packagesubscription($pkgId,Request $input)
    {
        if(Auth::user())
        {
            $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
            $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
            $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
            
            $mealtimecount=count(explode(",",$input['type']));
            
            $packageinfo=Package::where([['deleteId', '0'],['status','1'],['id',$pkgId]])->with('goal')->first();
            $userdetail=User::where('id',Auth::user()->id)->first();
            $useraddress=Address::where('userId',Auth::user()->id)->first();
            $userwallet=Wallet::where('userId',Auth::user()->id)->first();
            $pincodelist=pincode::where([['deleteId', '0'],['status','1']])->groupBy('pincode')->get();

            $fprice=$input['days']*$mealtimecount*$packageinfo['lPrice'];
            if($input['days']==3)
            {
                $finalamt=$fprice;
            }
            else if($input['days']==15)
            {
                $finalamt=$fprice-$fprice*5/100;
            }
            else if($input['days']==30)
            {
                $finalamt=$fprice-$fprice*10/100;
            }
            else if($input['days']==60)
            {
                $finalamt=$fprice-$fprice*15/100;
            }
            $finalamt=round($finalamt);
            $mindate = Carbon::now();
            $mindate=$mindate->addDays(1)->format('Y-m-d');
            $txnid = 'pk'.rand(99999, 9999999);

            return view('web.packagesubscription', compact('userwallet','txnid','mindate','userdetail','useraddress','pincodelist','categorylist','goallist','packageinfo','packagelist','input','mealtimecount','finalamt'));

        }
        else
        {
            return view('web.login');
        }
       }

    public function aboutus()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        return view('web.aboutus', compact('categorylist','goallist','packagelist'));
    }

    public function contactus()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        return view('web.contactus', compact('categorylist','goallist','packagelist'));
    }

    public function weblogout()
    {
        $this->storeLog('Logout', 'Logout', Auth::user()->id);
        Auth::logout();
        return redirect('/');
    }

    public function privacypolicy()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        return view('web.privacypolicy', compact('categorylist','goallist','packagelist'));
    }

    public function termsofservice()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        return view('web.termsofservice', compact('categorylist','goallist','packagelist'));
    }

    public function faqs()
    {
        $faqs = Faq::orderBy('sequence','asc')->get();
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        return view('web.faq', compact('faqs','categorylist','goallist','packagelist'));
    }
    
    public function myprofile()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $orderdetails=transction::where([['userId', Auth::user()->id],['trxFor','alacart']])->with('trxalacartorder')->orderBy('id','DESC')->get();
        $subscriptiondetails=transction::where([['userId', Auth::user()->id],['trxFor','subscription']])->with(['trxsubscriptionorder'=>function($qs){$qs->with('pkgdtl');}])->orderBy('id','DESC')->get();

        return view('web.myprofile', compact('categorylist','goallist','packagelist','orderdetails','subscriptiondetails'));
    }
    public function consultation()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $txnid = 'pk'.rand(99999, 9999999);
        return view('web.consultation', compact('categorylist','goallist','packagelist','txnid'));
    }
    
    public function allblogs()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $blogs = Blog::where('status',1)->where('deleteId','0')->orderBy('id','DESC')->get();
        return view('web.allblogs', compact('categorylist','goallist','packagelist','blogs'));
        
    }

    public function alacartcheckout()
    {   
        if(Auth::user())
        {
            $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
            $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
            $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
            $userdetail=User::where('id',Auth::user()->id)->first();
            $useraddress=Address::where('userId',Auth::user()->id)->first();
            $cartlist=cart::with('product')->with('addoncart')->where('userID', Auth::user()->id)->get();
            $pincodelist=pincode::where([['deleteId', '0'],['status','1']])->groupBy('pincode')->get();
            $userwallet=Wallet::where('userId',Auth::user()->id)->first();
            $txnid = 'pk'.rand(99999, 9999999);
            $userwallet=Wallet::where('userId',Auth::user()->id)->first();


            return view('web.alacartcheckout', compact('userwallet','txnid','categorylist','goallist','packagelist','cartlist','userdetail','useraddress','pincodelist'));
        }       
        else
        {
            return view('web.login');
        }
        
    }

    public function pincodechg($pincodeval)
    {   
        $pincodelist=pincode::where('pincode', $pincodeval)->get();

        $myresponse=[];
        $myresponse['status']='success';
        $myresponse['pincodelist']=$pincodelist;
        return $myresponse;
    }

    public function alacartorderplace(Request $input)
    {           
        $carb= Carbon::now(); 

        $trxId=transction::insertGetId([
            'trxdate' => $carb,
            'subtotalamt' => $input['subtotalval'],
            'discountamt' =>'0',
            'gstamt' => $input['taxval'],
            'deliveryamt' => $input['deliveryval'],
            'finalamt' => $input['finaltotalval'],
            'paymenId' => $input['paymentId'],
            'trxFor' => 'alacart',
            'userId' => Auth::user()->id,
            'address' => $input['addressdtl'],
            'landmark' => $input['landmark'],
            'pincode' => $input['pincode'],
            'deliverystatus'=>'InProcess',
            'area' => $input['area'],
            'cpname' => $input['username'],
            'cpno' => $input['mobilenumber'],
            'trxStatus' =>'Success'
        ]);

        transction::where('id',$trxId)->update([
            'invoiceno' => $trxId
        ]);

        $cartlist=cart::with('product')->with('addoncart')->where('userID', Auth::user()->id)->get();

        foreach ($cartlist as $key => $value) 
        {
            $addonval='';
            if(isset($value['addoncart']))
            {
                $productprice=$value['product']['discountedPrice'];
                $addonprice=$value['addoncart']['addon']['price'];
                $addonval=$value['addoncart']['addon']['description'].' - ('.$value['addoncart']['addon']['quantity'].' '.$value['addoncart']['addon']['unit'].')';
            }
            else
            {
                $productprice=$value['product']['discountedPrice']*$value['qty'];
                $addonprice=0;
                $addonval='';
            }
            $cartlist=alacartorder::insertGetId([
                'trxId' => $trxId,
                'productId' => $value['productId'],
                'productName' => $value['product']['name'],
                'productImg' =>$value['product']['image'],
                'qty' => $value['qty'],
                'addonName' => $addonval,
                'addonprice'=>$addonprice,
                'productPrice' => $productprice,
            ]);
        }

        cart::where('userID', Auth::user()->id)->delete();
        
        $trxdtl=transction::where('id',$trxId)->with('trxalacartorder')->first();
        return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl]);
    }

    public function orderdetails()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $orderdetails=transction::where([['userId', Auth::user()->id],['trxFor','alacart']])->with('trxalacartorder')->orderBy('id','DESC')->get();

        return view('web.orderdetails', compact('categorylist','goallist','packagelist','orderdetails'));
    }

    public function subscriptionorderplace(Request $input)
    {

        $carb= Carbon::now(); 

        $trxId=transction::insertGetId([
            'trxdate' => $carb,
            'subtotalamt' => $input['subtotalval'],
            'discountamt' =>'0',
            'gstamt' => $input['taxval'],
            'deliveryamt' => $input['deliveryval'],
            'finalamt' => $input['finaltotalval'],
            'paymenId' => $input['paymentId'],
            'trxFor' => 'subscription',
            'userId' => Auth::user()->id,
            'address' => $input['addressdtl'],
            'landmark' => $input['landmark'],
            'pincode' => $input['pincode'],
            'deliverystatus'=>'InProcess',
            'area' => $input['area'],
            'cpname' => $input['username'],
            'cpno' => $input['mobilenumber'],
            'trxStatus' =>'Success'
        ]);

        transction::where('id',$trxId)->update([
            'invoiceno' => $trxId
        ]);

        $cartlist=subscriptionorder::insertGetId([
            'trxId' => $trxId,
            'userId' => Auth::user()->id,
            'packageId' =>$input['packageid'],
            'totaldays' =>$input['days'],
            'totalmeal' =>$input['totalmeals'],
            'subscribedfor' => $input['subscribefor'],
            'startdate'=>$input['startdate'],
            'status' =>"Booked",
        ]);

        $trxdtl=transction::where('id',$trxId)->with('trxsubscriptionorder')->first();
        return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl]);
    }

    public function deletesubscription($subid)
    {
        transction::where('id',$subid)->update([
            'deliverystatus' => 'cancelled'
        ]);

        subscriptionorder::where('trxId',$subid)->update([
            'status' =>"cancelled",
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully !',
        ]);
    }
    public function gethashofpayu(Request $input)
    {
        //salt = 4R38IvwiV57FwVpsgOvTXBdLE4tHUXFW  MBFfc0sn
        $myresponse=[];
        if($input['productinfo']=='AlaCartOrder')
        {
            $strdata=$input['key'].'|'.$input['txnid'].'|'.$input['amount'].'|'.$input['productinfo'].'|'.$input['firstname'].'|'.$input['email'].'|'.$input['udf1'].'||||'.$input['udf5'].'||||||4R38IvwiV57FwVpsgOvTXBdLE4tHUXFW';

            $key = hash("sha512",$strdata);
        }
        else if($input['productinfo']=='subscription')
        {
            $strdata=$input['key'].'|'.$input['txnid'].'|'.$input['amount'].'|'.$input['productinfo'].'|'.$input['firstname'].'|'.$input['email'].'|'.$input['udf1'].'|'.$input['udf2'].'|'.$input['udf3'].'|'.$input['udf4'].'|'.$input['udf5'].'||||||4R38IvwiV57FwVpsgOvTXBdLE4tHUXFW';

            $key = hash("sha512",$strdata);
        }
        
        $myresponse['status']='success';
        $myresponse['encryptpass']=$key;
        $myresponse['strdata']=$strdata;
        return $myresponse;
    }

    public function payuresponsepkhk(Request $input)
    {
       //return $input;
        //$input='{"mihpayid":"403993715528002169","mode":"UPI","status":"success","unmappedstatus":"failed","key":"gtKFFx","txnid":"pk8719762","amount":"300.00","discount":"0.00","net_amount_debit":"0.00","addedon":"2022-12-30 10:52:57","productinfo":"AlaCartOrder","firstname":"Sayed Zaid","lastname":null,"address1":"Flat 07  anand dhan","address2":"near patel h","city":"B.P LANE","state":null,"country":null,"zipcode":"400003","email":"rishabh.2745@gmail.com","phone":"8433885667","udf1":"270,0,300,30,1,300","udf2":null,"udf3":null,"udf4":null,"udf5":"1","udf6":null,"udf7":null,"udf8":null,"udf9":null,"udf10":null,"hash":"636184f7353536fe36a56b296db0743772e825ceb562cf86f67791538a6a1ee58e310da2fe5fe1526736be276007d889005548fe259f8da1bb4db70393a63669","field1":"8976074007@ybl","field2":null,"field3":null,"field4":"RISHABH MAHENDRA KATARIYA","field5":null,"field6":null,"field7":null,"field8":null,"field9":"Transaction Failed at bank end.","payment_source":"payu","PG_TYPE":"HDFCU","bank_ref_num":null,"bankcode":"PP_UPI","error":"E308","error_Message":"Bank was unable to authenticate"}';
        //$input=json_decode($input,true);
        $carb= Carbon::now(); 
        
        if($input['productinfo']=='AlaCartOrder')
        {
            $trxdtl=explode (",", $input['udf1']);

            $walletamt=0;
            $payuamt=0;
            if($trxdtl['4']=='0')
            {
                $walletamt=0;
                $payuamt=$trxdtl[5];
            }
            else if($trxdtl['4']=='1')
            {
                $walletamt=Wallet::where('userId',$input['udf5'])->first();
                $walletamt=$walletamt['availableBal'];
                if($walletamt>=$trxdtl[5])
                {
                    $walletamt=$trxdtl[5];
                    $payuamt=0;
                }
                else
                {
                    
                    $payuamt=$trxdtl[5]-$walletamt;
                }
            }

            if($input['status']=='failure')
            {
                $ftrx=failtransction::where('payutxnid',$input['txnid'])->count();
                if($ftrx==0)
                {
                    $trxId=failtransction::insertGetId([
                        'trxdate' => $carb,
                        'subtotalamt' => $trxdtl[0],
                        'discountamt' =>'0',
                        'gstamt' => $trxdtl[1],
                        'deliveryamt' => $trxdtl[3],
                        'walletamt'=>$walletamt,
                        'payuamt'=>$payuamt,
                        'grandtotal' => $trxdtl[5],
                        'finalamt' => $trxdtl[2],
                        'paymenId' => $input['mihpayid'],
                        'trxFor' => 'alacart',
                        'userId' => $input['udf5'],
                        'address' => $input['address1'],
                        'landmark' => $input['address2'],
                        'pincode' => $input['zipcode'],
                        'deliverystatus'=>'InProcess',
                        'area' => $input['city'],
                        'cpname' => $input['firstname'],
                        'cpno' => $input['phone'],
                        'trxStatus' =>$input['status'],
                        'mode'=>$input['mode'],
                        'payutxnid'=>$input['txnid'],
                        'reason'=>$input['field9'],
                        'errormsg'=>$input['error_Message'],
                    ]);
        
        
                    $cartlist=cart::with('product')->with('addoncart')->where('userID', $input['udf5'])->get();
        
                    foreach ($cartlist as $key => $value) 
                    {
                        $addonval='';
                        if(isset($value['addoncart']))
                        {
                            $productprice=$value['product']['discountedPrice'];
                            $addonprice=$value['addoncart']['addon']['price'];
                            $addonval=$value['addoncart']['addon']['description'].' - ('.$value['addoncart']['addon']['quantity'].' '.$value['addoncart']['addon']['unit'].')';
                        }
                        else
                        {
                            $productprice=$value['product']['discountedPrice']*$value['qty'];
                            $addonprice=0;
                            $addonval='';
                        }
                        $cartlist=failalacartorder::insertGetId([
                            'trxId' => $trxId,
                            'productId' => $value['productId'],
                            'productName' => $value['product']['name'],
                            'productImg' =>$value['product']['image'],
                            'qty' => $value['qty'],
                            'addonName' => $addonval,
                            'addonprice'=>$addonprice,
                            'productPrice' => $productprice,
                        ]);
                    }
                }

                $result = User::where('id',$input['udf5'])->first();
                Auth::login($result);

                $trxdtl=failtransction::where('payutxnid',$input['txnid'])->with('trxalacartorder')->first();
                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl]);
            }
            else if($input['status']=='success')
            {
                $ftrx=transction::where('payutxnid',$input['txnid'])->count();
                if($ftrx==0)
                {
                    $trxId=transction::insertGetId([
                        'trxdate' => $carb,
                        'subtotalamt' => $trxdtl[0],
                        'discountamt' =>'0',
                        'gstamt' => $trxdtl[1],
                        'deliveryamt' =>  $trxdtl[3],
                        'walletamt'=>$walletamt,
                        'payuamt'=>$payuamt,
                        'grandtotal' => $trxdtl[5],
                        'finalamt' => $trxdtl[2],
                        'paymenId' => $input['mihpayid'],
                        'trxFor' => 'alacart',
                        'userId' => $input['udf5'],
                        'address' => $input['address1'],
                        'landmark' => $input['address2'],
                        'pincode' => $input['zipcode'],
                        'deliverystatus'=>'InProcess',
                        'area' => $input['city'],
                        'cpname' => $input['firstname'],
                        'cpno' => $input['phone'],
                        'trxStatus' =>$input['status'],
                        'mode'=>$input['mode'],
                        'payutxnid'=>$input['txnid'],
                        'reason'=>$input['field9'],
                        'errormsg'=>$input['error_Message'],
                    ]);
        
                    transction::where('id',$trxId)->update([
                        'invoiceno' => $trxId
                    ]);
        
                    $cartlist=cart::with('product')->with('addoncart')->where('userID', $input['udf5'])->get();
        
                    foreach ($cartlist as $key => $value) 
                    {
                        $addonval='';
                        if(isset($value['addoncart']))
                        {
                            $productprice=$value['product']['discountedPrice'];
                            $addonprice=$value['addoncart']['addon']['price'];
                            $addonval=$value['addoncart']['addon']['description'].' - ('.$value['addoncart']['addon']['quantity'].' '.$value['addoncart']['addon']['unit'].')';
                        }
                        else
                        {
                            $productprice=$value['product']['discountedPrice']*$value['qty'];
                            $addonprice=0;
                            $addonval='';
                        }
                        $cartlist=alacartorder::insertGetId([
                            'trxId' => $trxId,
                            'productId' => $value['productId'],
                            'productName' => $value['product']['name'],
                            'productImg' =>$value['product']['image'],
                            'qty' => $value['qty'],
                            'addonName' => $addonval,
                            'addonprice'=>$addonprice,
                            'productPrice' => $productprice,
                        ]);
                    }
        
                    $remark='Money Added for alacart order #PKHK_'.$input['txnid'];
                    $this->creditAmount($input['udf5'], $payuamt, 0,$trxId,'alacart', $remark);

                    $remark='Paid for alacart order #PKHK_'.$input['txnid'];
                    $this->debitAmount($input['udf5'],$trxdtl[5], 0,$trxId,'alacart', $remark);

                    cart::where('userID', $input['udf5'])->delete();
                }
                
                
                
                $result = User::where('id',$input['udf5'])->first();
                Auth::login($result);

                $trxdtl=transction::where('payutxnid',$input['txnid'])->with('trxalacartorder')->first();
                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl]);
            }
        }
        else if($input['productinfo']=='subscription')
        {
            $trxdtl=explode (",", $input['udf1']);
            $pkgdtl=explode (",", $input['udf2']); 

            $walletamt=0;
            $payuamt=0;
            if($trxdtl['4']=='0')
            {
                $walletamt=0;
                $payuamt=$trxdtl[5];
            }
            else if($trxdtl['4']=='1')
            {
                $walletamt=Wallet::where('userId',$input['udf5'])->first();
                $walletamt=$walletamt['availableBal'];
                if($walletamt>=$trxdtl[5])
                {
                    $walletamt=$trxdtl[5];
                    $payuamt=0;
                }
                else
                {
                    $payuamt=$trxdtl[5]-$walletamt;
                }
            }

            if($input['status']=='failure')
            {
                $ftrx=failtransction::where('payutxnid',$input['txnid'])->count();
                if($ftrx==0)
                {
                    $trxId=failtransction::insertGetId([
                        'trxdate' => $carb,
                        'subtotalamt' => $trxdtl[0],
                        'discountamt' =>'0',
                        'gstamt' => $trxdtl[1],
                        'deliveryamt' => '0',
                        'walletamt'=>$walletamt,
                        'payuamt'=>$payuamt,
                        'grandtotal' => $trxdtl[5],
                        'finalamt' => $trxdtl[2],
                        'paymenId' => $input['mihpayid'],
                        'trxFor' => 'subscription',
                        'userId' => $input['udf5'],
                        'address' => $input['address1'],
                        'landmark' => $input['address2'],
                        'pincode' => $input['zipcode'],
                        'deliverystatus'=>'InProcess',
                        'area' => $input['city'],
                        'cpname' => $input['firstname'],
                        'cpno' => $input['phone'],
                        'trxStatus' =>$input['status'],
                        'mode'=>$input['mode'],
                        'payutxnid'=>$input['txnid'],
                        'reason'=>$input['field9'],
                        'errormsg'=>$input['error_Message'],
                    ]);
            
                    $onemealprice=$trxdtl[3]/23;

                    $cartlist=failsubscriptionorder::insertGetId([
                        'trxId' => $trxId,
                        'userId' => $input['udf5'],
                        'packageId' =>$pkgdtl[0],
                        'totaldays' =>$pkgdtl[1],
                        'totalmeal' =>$pkgdtl[2],
                        'mealPrice' =>$onemealprice,
                        'subscribedfor' => $input['udf3'],
                        'startdate'=>$input['udf4'],
                        'status' =>$input['status'],
                    ]);
            
                    $result = User::where('id',$input['udf5'])->first();
                    Auth::login($result);

                    $trxdtl=failtransction::where('payutxnid',$input['txnid'])->with('trxalacartorder')->first();
                    return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl]);
                }
            }
            else if($input['status']=='success')
            {
                $ftrx=transction::where('payutxnid',$input['txnid'])->count();
                if($ftrx==0)
                {
                    $trxId=transction::insertGetId([
                        'trxdate' => $carb,
                        'subtotalamt' => $trxdtl[0],
                        'discountamt' =>'0',
                        'gstamt' => $trxdtl[1],
                        'deliveryamt' => '0',
                        'walletamt'=>$walletamt,
                        'payuamt'=>$payuamt,
                        'grandtotal' => $trxdtl[5],
                        'finalamt' => $trxdtl[2],
                        'paymenId' => $input['mihpayid'],
                        'trxFor' => 'subscription',
                        'userId' => $input['udf5'],
                        'address' => $input['address1'],
                        'landmark' => $input['address2'],
                        'pincode' => $input['zipcode'],
                        'deliverystatus'=>'InProcess',
                        'area' => $input['city'],
                        'cpname' => $input['firstname'],
                        'cpno' => $input['phone'],
                        'trxStatus' =>$input['status'],
                        'mode'=>$input['mode'],
                        'payutxnid'=>$input['txnid'],
                        'reason'=>$input['field9'],
                        'errormsg'=>$input['error_Message'],
                    ]);

                    transction::where('id',$trxId)->update([
                        'invoiceno' => $trxId
                    ]);
                    $onemealprice=$trxdtl[3]/23;
            
                    $cartlist=subscriptionorder::insertGetId([
                        'trxId' => $trxId,
                        'userId' => $input['udf5'],
                        'packageId' =>$pkgdtl[0],
                        'totaldays' =>$pkgdtl[1],
                        'totalmeal' =>$pkgdtl[2],
                        'mealPrice' =>$onemealprice,
                        'subscribedfor' => $input['udf3'],
                        'startdate'=>$input['udf4'],
                        'status' =>"Booked",
                    ]);

                    $remark='Money Added for subscription order #PKHK_'.$input['txnid'];
                    $this->creditAmount($input['udf5'], $payuamt, 0,$trxId,'subscription', $remark);

                    $remark='Locked for subscription order #PKHK_'.$input['txnid'];
                    $this->lockamount($input['udf5'], $trxdtl[5], $trxdtl[5],$trxId,'subscription', $remark);
                }
                $result = User::where('id',$input['udf5'])->first();
                Auth::login($result);

                $trxdtl=transction::where('payutxnid',$input['txnid'])->with('trxalacartorder')->first();
                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl]);
            }
        }
    }

    public function undefined(Request $input)
    {
        return $input;
    }
}