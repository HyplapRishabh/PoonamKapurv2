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
use App\Models\User;
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
                $cartId=cart::insertGetId([
                    'productId' => $productId,
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
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        $mealtimecount=count(explode(",",$input['type']));
        
        $packageinfo=Package::where([['deleteId', '0'],['status','1'],['id',$pkgId]])->with('goal')->first();
        $userdetail=User::where('id',Auth::user()->id)->first();
        $useraddress=Address::where('userId',Auth::user()->id)->first();
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

        return view('web.packagesubscription', compact('mindate','userdetail','useraddress','pincodelist','categorylist','goallist','packageinfo','packagelist','input','mealtimecount','finalamt'));
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
        
        return view('web.consultation', compact('categorylist','goallist','packagelist'));
    }
    
    public function allblogs()
    {
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        
        return view('web.allblogs', compact('categorylist','goallist','packagelist'));
        
    }

    public function alacartcheckout()
    {   
        $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $userdetail=User::where('id',Auth::user()->id)->first();
        $useraddress=Address::where('userId',Auth::user()->id)->first();
        $cartlist=cart::with('product')->with('addoncart')->where('userID', Auth::user()->id)->get();
        $pincodelist=pincode::where([['deleteId', '0'],['status','1']])->groupBy('pincode')->get();

        return view('web.alacartcheckout', compact('categorylist','goallist','packagelist','cartlist','userdetail','useraddress','pincodelist'));
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
}