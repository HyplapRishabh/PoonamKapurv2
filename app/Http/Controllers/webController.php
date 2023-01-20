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
use App\Models\Banner;
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
use App\Models\failconsultation;
use App\Models\consultation;
use App\Models\Enquiryfranchise;
use App\Models\Faq;
use App\Models\User;
use  App\Models\Walletremark;
use App\Models\failtransction;
use App\Models\failalacartorder;
use App\Models\failsubscriptionorder;
use App\Models\Resetpassword;
use Barryvdh\DomPDF\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
    public function __construct()
    {
        if (Auth::check()) {
            $cartCount = cart::where('userId', Auth::user()->id)->count();
        } else {
            $cartCount = 0;
        }
        view()->share('cartCount', $cartCount);
    }

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
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $banners = Banner::orderBy('sequence','Asc')->get();

        $testimonials = Testimonial::where([['deleteId', '0'], ['status', '1']])->get();
        return view('web.welcomeindex', compact('categorylist', 'packagelist', 'goallist', 'testimonials','banners'));
    }

    public function allcategory()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        $categoryall = Category::where([['deleteId', '0'], ['status', '1']])->get();
        return view('web.allcategory', compact('categorylist', 'packagelist', 'goallist', 'categoryall'));
    }

    public function allgoal()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        $categoryall = Category::where([['deleteId', '0'], ['status', '1']])->get();
        return view('web.allgoal', compact('categorylist', 'packagelist', 'goallist', 'categoryall'));
    }

    public function categorydetail($catslug, Request $input)
    {
        $mealtypedtl = $input['mealtype'];

        if (isset($mealtypedtl)) {
            $mealtypedtl = mealtype::where([['deleteId', '0'], ['status', '1']])->where('name', $mealtypedtl)->pluck('id')->first();
        }
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        $checktitle = $this->sanitizeStringForUrl($catslug);
        $categorydtl = Category::where([['deleteId', '0'], ['status', '1']])->where('name', $checktitle)->first();
        $mealTypes = Product::with('webmealtype')->groupBy('mealTypeId')
            ->select('categoryId', 'status', 'deleteId', 'mealTypeId', DB::raw('count(*) as totalmealTypeId'))
            ->where([['categoryId', $categorydtl['id']], ['deleteId', '0'], ['status', '1']])->get();

        return view('web.category', compact('categorylist', 'goallist', 'packagelist', 'categorydtl', 'mealTypes', 'input'));
    }

    public function getcartdata()
    {
        if (Auth::user()) {
            $cartlist = cart::with('product')->with('addoncart')->where('userID', Auth::user()->id)->get();
        } else {
            $cartlist = [];
        }

        $myresponse['cartlist'] = $cartlist;
        $myresponse['status'] = 'success';
        return $myresponse;
    }

    public function getproductfilter(Request $input)
    {
        $mealtypedtl = $input['mealtype'];

        if (isset($mealtypedtl)) {
            $mealtypedtl = mealtype::where([['deleteId', '0'], ['status', '1']])->where('name', $mealtypedtl)->pluck('id')->first();
        }

        $categorydtl = $input['category'];

        if (isset($categorydtl)) {
            $checktitle = $this->sanitizeStringForUrl($categorydtl);
            $categorydtl = Category::where([['deleteId', '0'], ['status', '1']])->where('name', $checktitle)->first();
        }

        $productdtl = Product::where([['categoryId', $categorydtl['id']], ['deleteId', '0'], ['status', '1']])
            ->when($mealtypedtl, function ($q) use ($mealtypedtl) {
                return $q->where('mealTypeId', '=', $mealtypedtl);
            })
            ->inRandomOrder()->get();

        $myresponse['productdtl'] = $productdtl;
        $myresponse['status'] = 'success';
        return $myresponse;
    }

    public function indexFranchisee()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        return view('web.franchiseeEnquiry', compact('categorylist', 'packagelist', 'goallist'));
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

        $this->sendEmail('FranchiseToUser', $request->email, $request->name, $request->name, $request->phone, $request->email, '', '', '', '' );
        $this->sendEmail('FranchiseToPoonam', 'poonamkapur77@gmail.com', 'Poonam Kapur', $request->name, $request->phone, $request->email, '', '', '', '' );

        return redirect()->back()->with('success', 'Thank you for your enquiry. We will get back to you soon.');
    }

    // Bulk  Enquiry Submission

    public function indexBulk()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        return view('web.bulkEnquiry', compact('categorylist', 'packagelist', 'goallist'));
    }

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

        $this->sendEmail('BulkToUser', $request->email, $request->name, $request->name, $request->phone, $request->email, '', '', '', '' );
        $this->sendEmail('BulkToPoonam', 'poonamkapur77@gmail.com', 'Poonam Kapur', $request->name, $request->phone, $request->email, '', '', '', '' );


        return redirect()->back()->with('success', 'Thank you for your enquiry. We will get back to you soon.');
    }

    public function getgoalpkg(Request $input)
    {
        $mealtypedtlval = $input['meal'];

        if (isset($mealtypedtlval)) {
            $mealtypedtl = mealtype::where([['deleteId', '0'], ['status', '1']])->where('name', $mealtypedtlval)->first();
        }

        $pkgdtl = Package::where([['deleteId', '0'], ['status', '1'], ['goalId', $input['goal']], ['mealTypeId', $mealtypedtl['id']]])->with('mealtype')->first();

        $myresponse['pkgdtl'] = $pkgdtl;
        $myresponse['mealtypedtl'] = $mealtypedtl['id'];
        $myresponse['days'] = ['3', '15', '30', '60'];
        $myresponse['status'] = 'success';
        return $myresponse;
    }


    public function alacart()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        $categoryall = Category::where([['deleteId', '0'], ['status', '1']])->get();
        $productdtl = Product::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('16')->get();

        return view('web.alacart', compact('categorylist', 'goallist', 'packagelist', 'categoryall', 'productdtl'));
    }


    function sanitizeStringForUrl($string)
    {
        $string = preg_replace('#-#', ' ', $string);
        return $string;
    }

    function addonlist($productId, $mealId, $cartId)
    {
        $myresponse = [];
        if (Auth::user()) {
            $cartexist = cartaddon::where('cartId', $cartId)->pluck('addonId')->first();
            $addonlist = Addon::where([['deleteId', '0'], ['status', '1'], ['mealTypeId', $mealId], ['alaCartFlag', '1']])->with('mealtype')->get();

            $myresponse['status'] = 'success';
            $myresponse['addonlist'] = $addonlist;
            $myresponse['cartexist'] = $cartexist;
            return $myresponse;
        } else {
            $myresponse['status'] = 'login';
            return $myresponse;
        }
    }

    function addtocart($productId, $addonval)
    {
        $productUID = Product::where('id', $productId)->first()->UID;
        error_log('productId' . $productUID);
        $myresponse = [];
        if (Auth::user()) {
            $cartexist = cart::where([['productId', $productUID], ['userID', Auth::user()->id]])->first();
            error_log('cartexist' . $cartexist);

            if ($cartexist) {
                error_log('cartexist' . $cartexist['id']);
                $cart = cart::find($cartexist['id']);
                $cart->qty = $cartexist['qty'] + 1;
                $cart->update();
                $cartId = $cartexist['id'];
            } else {
                $dishdtl = Product::where('id', $productId)->first();

                $cartId = cart::insertGetId([
                    'productId' => $dishdtl['UID'],
                    'qty' => 1,
                    'userID' => Auth::user()->id,
                ]);
            }

            if ($addonval != 0) {
                $cartexist = cartaddon::where('cartId', $cartId)->delete();
                $cartaddon = cartaddon::insertGetId([
                    'cartId' => $cartId,
                    'addonId' => $addonval,
                    'qty' => '1',
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Added to cart !',
            ]);
        } else {
            $myresponse['status'] = 'login';
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
            if ($result->status == 1 && $result->deleteId == 0) {
                if (Hash::check($input['passwordval'], $result->password)) {
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

    function checkOldUser(Request $request)
    {
        $user = User::where('phone', $request->mobile)->first();
        if($user)
        {
            return response()->json([
                'status' => 200,
                'user'=> $user,
                'message' => 'Already a user',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 201,
                'message' => 'New user',
            ]);
        }
    }

    function savePersonalDtl(Request $request)
    {
        
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->mobile;
            $user->password = Hash::make($request->pass);
            $user->status = 1;
            $user->deleteId = 0;
            $user->role = 4;
            $user->save();
            Auth::login($user);
            $this->createWalletUser($user->id);
            return response()->json([
                'status' => 200,
                'userId'=> $user->id,
                'message' => 'Registered succesfully',
            ]);
    }

    public function checkPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user)
        {
            if (Hash::check($request->pass, $user->password)) {
                Auth::login($user);
                return response()->json([
                    'status' => 200,
                    'message' => 'Password Matched',
                ]);
            } else {
                return response()->json([
                    'status' => 202,
                    'message' => 'Password Not Matched',
                ]);
            }
        }
        else{
            return response()->json([
                'status' => 201,
                'message' => 'Incorrect Email',
            ]);
        }
        
    }

    public function saveHeightWeightDtl(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->bmi = $request->bmi;
        $user->bmr = $request->bmr;
        $user->update();
        return response()->json([
            'status' => 200,
            'message' => 'Added All remaining details succesfully',
        ]);
    }

    public function resetpassword()
    {
        return view('web.resetpassword');
    }

    public function checkresetpass(Request $input)
    {

        $result = User::where(['email' => $input['emailId']])->first();

        if ($result) {
            if ($result->status == 1 && $result->deleteId == 0) {

                $tokenGenerate = Resetpassword::updateOrCreate(
                    ['userId' => $result->id],
                    ['token' => Str::random(60)]
                ); 
                // error_log($tokenGenerate->id);
                $token = Crypt::encryptString($tokenGenerate->id);
                $this->sendEmail('ForgetPassword', $input->emailId, $result->name, $result->name, $result->phone, $result->email, '', $token, '', '' );

                return response()->json([
                    'status' => 200,
                    'message' => 'Reset password link sent on E-mail.',
                ]);
            } else {
                return response()->json([
                    'status' => 201,
                    'message' => 'Contact site admin to change your password !',
                ]);
            }
        } else {
            return response()->json([
                'status' => 202,
                'message' => "Email Id doesn't exist !",
            ]);
        }
    }

    public function resetpass($token)
    {
        $token = Crypt::decryptString($token);
        $resetPassDetails = Resetpassword::where('id', $token)->first();
        // return $getTimestamp;
        $receivedTimestamp = strtotime($resetPassDetails->updated_at);
        // return $receivedTimestamp;
        
        // check if token is 2 hours old
        if (time() - $receivedTimestamp > 7200) {
            return 'Your link has expired. Please try generating a new reset password link!!';
        } else {
            return view('web.resetpass', compact('resetPassDetails'));
        }
    }

    public function confirmresetpass(Request $input)
    {
        $result = User::where(['id' => $input['hiddenUserId']])->first();
        if ($result) {
            $result->password = Hash::make($input['password']);
            $result->update();
            return redirect('/');
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

        if ($resultemail) {
            return response()->json([
                'status' => 'emailerror',
                'message' => 'Email Id already exist !',
            ]);
        } else if ($resultphone) {
            return response()->json([
                'status' => 'phoneerror',
                'message' => 'mobile number already exist !',
            ]);
        } else {
            $user = new User();
            $user->name = $request->uname;
            $user->email = $request->uemail;
            $user->phone = $request->uphone;
            $user->role = 4;
            $user->status = '1';
            $user->password = Hash::make($request->upassword);
            $user->save();
            $this->createWalletUser($user->id);
            $resultemail = User::Where(['email' => $request['uemail']])->first();

            Auth::login($resultemail);
            return response()->json([
                'status' => 200,
                'message' => 'Profile Created succesfully !',
            ]);
        }
    }

    public function quizsignup(Request $request)
    {

        $resultemail = User::Where(['email' => $request['quemail']])->first();

        if ($resultemail) {
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
        } else {

            $userid = User::insertGetId([
                'name' => $request->quname,
                'email' => $request->quemail,
                'phone'=>$request->quemobile,
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
            $this->createWalletUser($userid);
            Auth::login($resultemail);
        }

        // $goallist = Goal::where([['deleteId', '0'], ['status', '1'], ['id', $request->qgoal]])->with('package')->first();

        return response()->json([
            'status' => 200,
            'message' => '/app/allgoal',
        ]);
    }

    public function signupotp(Request $input)
    {

        $resultphone = User::where(['phone' => $input['uphone']])->count();

        if ($resultphone) {
            return response()->json([
                'status' => 'phoneerror',
                'message' => 'mobile number already exist !',
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'OTP send successfully !',
            ]);
        }
    }

    public function viewcart()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        $productlist = Product::with('category')->where([['deleteId', '0'], ['status', '1']])->limit('8')->get();

        $cartlist = cart::with('product')->with('addoncart')->where('userID', Auth::user()->id)->get();

        return view('web.viewcart', compact('categorylist', 'goallist', 'packagelist', 'productlist', 'cartlist'));
    }

    public function dish($pname)
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        $dishdtl = Product::with('category')->where([['deleteId', '0'], ['status', '1']])->where('slug', $pname)->first();
        $dishmacros = Productmacro::where('productUId', $dishdtl['UID'])->first();
        $dishaddonlist = Addon::where([['deleteId', '0'], ['status', '1'], ['mealTypeId', $dishdtl['mealTypeId']], ['alaCartFlag', '1']])->with('mealtype')->get();
        $similarproduct = Product::with('category')->where([['deleteId', '0'], ['status', '1'], ['categoryId', $dishdtl['categoryId']]])->inRandomOrder()->limit('8')->get();
        return view('web.dish', compact('categorylist', 'goallist', 'packagelist', 'dishdtl', 'dishmacros', 'dishaddonlist', 'similarproduct'));
    }

    public function deletefromcart($cartid)
    {
        $cartlist = cart::where('id', $cartid)->delete();
        $cartexist = cartaddon::where('cartId', $cartid)->delete();
        $myresponse['status'] = 'success';
        return $myresponse;
    }

    public function updatecart($type, $cartid)
    {

        if ($type == 'sub') {
            $cartlist = cart::where('id', $cartid)->first();
            if ($cartlist['qty'] - 1 == 0) {
                $cartlist = cart::where('id', $cartid)->delete();
                $cartexist = cartaddon::where('cartId', $cartid)->delete();
            } else {
                $cartlist = cart::where('id', $cartid)->decrement('qty', 1);
            }
        } else {
            $cartlist = cart::where('id', $cartid)->increment('qty', 1);
        }

        $myresponse['status'] = 'success';
        return $myresponse;
    }

    public function goaldetail($goal, Request $input)
    {
        // return $input->all();
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $checktitle = $this->sanitizeStringForUrl($goal);
        $goaldtl = Goal::where([['deleteId', '0'], ['status', '1']])->where('name', $checktitle)->first();
        $goalpkg = Package::where([['deleteId', '0'], ['status', '1'], ['goalId', $goaldtl['id']]])->with('mealtype')->get();
        // return $goalpkg;

        return view('web.goaldetail', compact('categorylist', 'goallist', 'packagelist', 'goaldtl', 'goalpkg', 'input'));
    }

    public function packagemenu($pkgId, Request $input)
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $packageinfo = Package::where([['deleteId', '0'], ['status', '1'], ['id', $pkgId]])->first();
        $menuinfo = packagemenu::where('packageUId', $packageinfo['UID'])->with('webbreakfast')->with('weblunch')->with('websnacks')->with('webdinner')->limit($input['days'])->orderBy('day')->get();
        

        return view('web.packagemenu', compact('categorylist', 'goallist', 'packageinfo', 'packagelist', 'menuinfo', 'input'));
    }

    public function packagesubscription($pkgId, Request $input)
    {
        if(Auth::user())
        {
            $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
            $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
            $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
    
            $mealtimecount = count(explode(",", $input['type']));
    
            $packageinfo = Package::where([['deleteId', '0'], ['status', '1'], ['id', $pkgId]])->with('goal')->first();
            $userdetail = User::where('id', Auth::user()->id)->first();
            $useraddress = Address::where('userId', Auth::user()->id)->first();
            $userwallet=Wallet::where('userId',Auth::user()->id)->first();
            $pincodelist = pincode::where([['deleteId', '0'], ['status', '1']])->groupBy('pincode')->get();

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

            return view('web.packagesubscription', compact('userwallet','txnid','mindate', 'userdetail', 'useraddress', 'pincodelist', 'categorylist', 'goallist', 'packageinfo', 'packagelist', 'input', 'mealtimecount', 'finalamt'));

        }
        else
        {
            return view('web.login');
        }
       }

    public function aboutus()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        return view('web.aboutus', compact('categorylist', 'goallist', 'packagelist'));
    }

    public function contactus()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        return view('web.contactus', compact('categorylist', 'goallist', 'packagelist'));
    }

    public function weblogout()
    {
        $this->storeLog('Logout', 'Logout', Auth::user()->id);
        Auth::logout();
        return redirect('/');
    }

    public function privacypolicy()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        return view('web.privacypolicy', compact('categorylist', 'goallist', 'packagelist'));
    }

    public function termsofservice()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        return view('web.termsofservice', compact('categorylist', 'goallist', 'packagelist'));
    }

    public function faqs()
    {
        $faqs = Faq::orderBy('sequence', 'asc')->get();
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();

        return view('web.faq', compact('faqs', 'categorylist', 'goallist', 'packagelist'));
    }

    public function myprofile()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $orderdetails = transction::where([['userId', Auth::user()->id], ['trxFor', 'alacart']])->with('trxalacartorder')->orderBy('id', 'DESC')->get();
        $subscriptiondetails = transction::where([['userId', Auth::user()->id], ['trxFor', 'subscription']])->with(['trxsubscriptionorder' => function ($qs) {
            $qs->with('pkgdtl');
        }])->orderBy('id', 'DESC')->get();

        return view('web.myprofile', compact('categorylist', 'goallist', 'packagelist', 'orderdetails', 'subscriptiondetails'));
    }
    public function consultation()
    {
        if(Auth::user())
        {
            $userwallet=Wallet::where('userId',Auth::user()->id)->first();
            $categorylist = Category::where([['deleteId', '0'],['status','1']])->inRandomOrder()->limit('6')->get();
            $goallist = Goal::where([['deleteId', '0'],['status','1']])->with('package')->get();
            $packagelist = Package::where([['deleteId', '0'],['status','1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
            $txnid = 'pk'.rand(99999, 9999999);
            $mindate = Carbon::now();
            $finalamt=500;
            $mindate=$mindate->addDays(1)->format('Y-m-d');
            
            return view('web.consultation', compact('categorylist','goallist','packagelist','txnid','mindate','userwallet','finalamt'));
        }
        else
        {
            return view('web.login');
        }
    }

    // public function submitConsultation(Request $request)
    // {
    //     $consultation = new consultation();
    //     $consultation->name = $request->name;
    //     $consultation->email = $request->email;
    //     $consultation->number = $request->phone;
    //     $consultation->date = $request->callBackDate;
    //     $consultation->msg = $request->message;
    //     $consultation->save();
    //     return redirect()->back()->with('success', 'Your request has been submitted successfully');
    // }

    public function allblogs()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $blogs = Blog::where('status', 1)->where('deleteId', '0')->orderBy('id', 'DESC')->get();
        return view('web.allblogs', compact('categorylist', 'goallist', 'packagelist', 'blogs'));
    }

    public function singleBlog($slug)
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $blogs = Blog::where('status', 1)->where('deleteId', '0')->inRandomOrder()->limit('3')->get();
        $blog = Blog::where('slug', $slug)->first();
        return view('web.singleBlog', compact('categorylist', 'goallist', 'packagelist', 'blogs', 'blog'));
    }

    public function alacartcheckout()
    {   
        if(Auth::user())
     {
            $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
            $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
            $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
            $userdetail = User::where('id', Auth::user()->id)->first();
            $useraddress = Address::where('userId', Auth::user()->id)->first();
            $cartlist = cart::with('product')->with('addoncart')->where('userID', Auth::user()->id)->get();
            $pincodelist = pincode::where([['deleteId', '0'], ['status', '1']])->groupBy('pincode')->get();
            $userwallet=Wallet::where('userId',Auth::user()->id)->first();
            $txnid = 'pk' . rand(99999, 9999999);
            $userwallet=Wallet::where('userId',Auth::user()->id)->first();


            return view('web.alacartcheckout', compact('userwallet','txnid', 'categorylist', 'goallist', 'packagelist', 'cartlist', 'userdetail', 'useraddress', 'pincodelist'));
        }       
        else
        {
            return view('web.login');
        }
        
    }

    public function pincodechg($pincodeval)
    {
        $pincodelist = pincode::where('pincode', $pincodeval)->get();

        $myresponse = [];
        $myresponse['status'] = 'success';
        $myresponse['pincodelist'] = $pincodelist;
        return $myresponse;
    }

    public function cityvalchg($cityval)
    {
        $citylist = pincode::where('areaName', $cityval)->first();

        $myresponse = [];
        $myresponse['status'] = 'success';
        $myresponse['citylist'] = $citylist;
        return $myresponse;
    }
    
    public function alacartorderplace(Request $input)
    {
        $carb = Carbon::now();

        $trxId = transction::insertGetId([
            'trxdate' => $carb,
            'subtotalamt' => $input['subtotalval'],
            'discountamt' => '0',
            'gstamt' => $input['taxval'],
            'deliveryamt' => $input['deliveryval'],
            'finalamt' => $input['finaltotalval'],
            'paymenId' => $input['paymentId'],
            'trxFor' => 'alacart',
            'userId' => Auth::user()->id,
            'address' => $input['addressdtl'],
            'landmark' => $input['landmark'],
            'pincode' => $input['pincode'],
            'deliverystatus' => 'InProcess',
            'area' => $input['area'],
            'cpname' => $input['username'],
            'cpno' => $input['mobilenumber'],
            'trxStatus' => 'Success'
        ]);

        transction::where('id', $trxId)->update([
            'invoiceno' => $trxId
        ]);

        $cartlist = cart::with('product')->with('addoncart')->where('userID', Auth::user()->id)->get();

        foreach ($cartlist as $key => $value) {
            $addonval = '';
            if (isset($value['addoncart'])) {
                $productprice = $value['product']['discountedPrice'];
                $addonprice = $value['addoncart']['addon']['price'];
                $addonval = $value['addoncart']['addon']['description'] . ' - (' . $value['addoncart']['addon']['quantity'] . ' ' . $value['addoncart']['addon']['unit'] . ')';
            } else {
                $productprice = $value['product']['discountedPrice'] * $value['qty'];
                $addonprice = 0;
                $addonval = '';
            }
            $cartlist = alacartorder::insertGetId([
                'trxId' => $trxId,
                'productId' => $value['productId'],
                'productName' => $value['product']['name'],
                'productImg' => $value['product']['image'],
                'qty' => $value['qty'],
                'addonName' => $addonval,
                'addonprice' => $addonprice,
                'productPrice' => $productprice,
            ]);
        }

        cart::where('userID', Auth::user()->id)->delete();

        $trxdtl = transction::where('id', $trxId)->with('trxalacartorder')->first();
        $packagedtl = [];

        // email 
        

                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
    }

    public function orderdetails()
    {
        $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
        $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
        $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
        $orderdetails = transction::where([['userId', Auth::user()->id], ['trxFor', 'alacart']])->with('trxalacartorder')->orderBy('id', 'DESC')->get();

        return view('web.orderdetails', compact('categorylist', 'goallist', 'packagelist', 'orderdetails'));
    }

    public function subscriptionorderplace(Request $input)
    {

        $carb = Carbon::now();

        $trxId = transction::insertGetId([
            'trxdate' => $carb,
            'subtotalamt' => $input['subtotalval'],
            'discountamt' => '0',
            'gstamt' => $input['taxval'],
            'deliveryamt' => $input['deliveryval'],
            'finalamt' => $input['finaltotalval'],
            'paymenId' => $input['paymentId'],
            'trxFor' => 'subscription',
            'userId' => Auth::user()->id,
            'address' => $input['addressdtl'],
            'landmark' => $input['landmark'],
            'pincode' => $input['pincode'],
            'deliverystatus' => 'InProcess',
            'area' => $input['area'],
            'cpname' => $input['username'],
            'cpno' => $input['mobilenumber'],
            'trxStatus' => 'Success'
        ]);

        transction::where('id', $trxId)->update([
            'invoiceno' => $trxId
        ]);

        $cartlist = subscriptionorder::insertGetId([
            'trxId' => $trxId,
            'userId' => Auth::user()->id,
            'packageId' => $input['packageid'],
            'totaldays' => $input['days'],
            'totalmeal' => $input['totalmeals'],
            'subscribedfor' => $input['subscribefor'],
            'startdate' => $input['startdate'],
            'status' => "Booked",
        ]);

        $trxdtl = transction::where('id', $trxId)->with('trxsubscriptionorder')->first();
        return view('web.alacartsuccess')->with(['trxdtl' => $trxdtl]);
    }

    public function deletesubscription($subid)
    {
        transction::where('id', $subid)->update([
            'deliverystatus' => 'cancelled'
        ]);

        subscriptionorder::where('trxId', $subid)->update([
            'status' => "cancelled",
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully !',
        ]);
    }
    public function gethashofpayu(Request $input)
    {
        //salt = 4R38IvwiV57FwVpsgOvTXBdLE4tHUXFW  MBFfc0sn
        $myresponse = [];
        if($input['productinfo']=='AlaCartOrder')
        {
            $strdata=$input['key'].'|'.$input['txnid'].'|'.$input['amount'].'|'.$input['productinfo'].'|'.$input['firstname'].'|'.$input['email'].'|'.$input['udf1'].'||||'.$input['udf5'].'||||||MBFfc0sn';

            $key = hash("sha512",$strdata);
        }
        else if($input['productinfo']=='subscription')
        {
            $strdata = $input['key'] . '|' . $input['txnid'] . '|' . $input['amount'] . '|' . $input['productinfo'] . '|' . $input['firstname'] . '|' . $input['email'] . '|' . $input['udf1'] . '|' . $input['udf2'] . '|' . $input['udf3'] . '|' . $input['udf4'] . '|' . $input['udf5'] . '||||||MBFfc0sn';

            $key = hash("sha512", $strdata);
        }
        else if($input['productinfo']=='consultation')
        {
            $strdata=$input['key'].'|'.$input['txnid'].'|'.$input['amount'].'|'.$input['productinfo'].'|'.$input['firstname'].'|'.$input['email'].'|'.$input['udf1'].'|'.$input['udf2'].'|'.$input['udf3'].'|'.$input['udf4'].'|'.$input['udf5'].'||||||MBFfc0sn';

            $key = hash("sha512",$strdata);
        }
        else if($input['productinfo']=='walletRecharge')
        {
            $strdata=$input['key'].'|'.$input['txnid'].'|'.$input['amount'].'|'.$input['productinfo'].'|'.$input['firstname'].'|'.$input['email'].'|'.$input['udf1'].'||||'.$input['udf5'].'||||||MBFfc0sn';

            $key = hash("sha512",$strdata);
        }

        $myresponse['status'] = 'success';
        $myresponse['encryptpass'] = $key;
        $myresponse['strdata'] = $strdata;
        return $myresponse;
    }

    public function payuresponsepkhk(Request $input)
    {
       return $input;
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
                $packagedtl = [];
                $this->sendEmail('OrderFailedToPoonam', 'poonamkapur77@gmail.com','Poonam Kapur', $input->firstname, $input->phone, $input->email, '', $input->address1, $input->address2, $input->zipcode );
                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
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
                $packagedtl = [];
                $this->sendEmail('OrderPlacedToUser', $result->email, $trxdtl->cpname, $trxdtl->cpname, $trxdtl->cpno, $result->email, $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );
                $this->sendEmail('OrderPlacedToPoonam', 'poonamkapur77@gmail.com', 'Poonam Kapur', $trxdtl->cpname, $trxdtl->cpno, $result->email, $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );
                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
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
                    $packagedtl = Package::where('id', $pkgdtl[0])->with('goal')->with('mealtype')->first();
                    $this->sendEmail('SubscriptionFailedToPoonam', 'poonamkapoor77@gmail.com', 'Poonam Kapoor', $trxdtl->cpname, $trxdtl->cpno, $result->email, $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );
                    return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
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
                $packagedtl = Package::where('id', $pkgdtl[0])->with('goal')->with('mealtype')->first();
                $this->sendEmail('SubscribedToUser', $result->email, $trxdtl->cpname, $trxdtl->cpname, $trxdtl->cpno, $result->email, $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );
                // not working
                $this->sendEmail('SubscribedToPoonam', 'szaid444666@gmail.com', 'Poonam Kapur', $trxdtl->cpname, $trxdtl->cpno, $result->email, $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );
                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
            }
        }

    }

    public function undefined(Request $input)
    {
        return $input;
    }

    public function payuresponseconsultpkhk(Request $input)
    {
        // $input='{"mihpayid":"403993715528003125","mode":"UPI","status":"failure","unmappedstatus":"failed","key":"gtKFFx","txnid":"pks65s42340","amount":"500.00","discount":"0.00","net_amount_debit":"0.00","addedon":"2022-12-30 12:13:22","productinfo":"consultation","firstname":"Sayed Zaid","lastname":null,"address1":null,"address2":null,"city":null,"state":null,"country":null,"zipcode":null,"email":"rishabh.2745@gmail.com","phone":"8433885667","udf1":"500","udf2":"2023-01-01","udf3":"Test pay","udf4":null,"udf5":"1","udf6":null,"udf7":null,"udf8":null,"udf9":null,"udf10":null,"hash":"a96fb4c13c6d1a497049efe6b7263ec208143342d5f5ddbbd8b3e7bfa3a25267ef444a84819ca6746547a2defe2d65b49b64acbcbc95fa503e35589cece70c94","field1":"8976074007@ybl","field2":null,"field3":null,"field4":"RISHABH MAHENDRA KATARIYA","field5":null,"field6":null,"field7":null,"field8":null,"field9":"Transaction Failed at bank end.","payment_source":"payu","PG_TYPE":"HDFCU","bank_ref_num":null,"bankcode":"PP_UPI","error":"E308","error_Message":"Bank was unable to authenticate"}';
        // $input=json_decode($input,true);

        $carb= Carbon::now(); 

        $trxdtl=explode (",", $input['udf1']);

            $walletamt=0;
            $payuamt=0;
            if ($input['udf4']=='0')
            {
                $walletamt=0;
                $payuamt=$input['udf4'];
            }
            else if($input['udf4']=='1')
            {
                $walletamt=Wallet::where('userId',$input['udf5'])->first();
                $walletamt=$walletamt['availableBal'];
                if($walletamt>=$input['udf1'])
                {
                    $walletamt=$input['udf1'];
                    $payuamt=0;
                }
                else
                {
                    
                    $payuamt=$input['udf1']-$walletamt;
                }
            }
            
        if($input['status']=='failure')
        {
            $ftrx=failtransction::where('payutxnid',$input['txnid'])->count();
                if($ftrx==0)
                {
                    $trxId=failtransction::insertGetId([
                        'trxdate' => $carb,
                        'subtotalamt' =>$input['udf1'],
                        'discountamt' =>'0',
                        'gstamt' => 0,
                        'deliveryamt' => '0',
                        'walletamt'=>$walletamt,
                        'payuamt'=>$payuamt,
                        'grandtotal' => $input['udf1'],
                        'finalamt' => $input['amount'],
                        'paymenId' => $input['mihpayid'],
                        'trxFor' => 'consultation',
                        'userId' => $input['udf5'],
                        'deliverystatus'=>'Pending',
                        'cpname' => $input['firstname'],
                        'cpno' => $input['phone'],
                        'trxStatus' =>$input['status'],
                        'mode'=>$input['mode'],
                        'payutxnid'=>$input['txnid'],
                        'reason'=>$input['field9'],
                        'errormsg'=>$input['error_Message'],
                    ]);
            

                    $cartlist=failconsultation::insertGetId([
                        'trxId' => $trxId,
                        'name' => $input['firstname'],
                        'number' =>$input['phone'],
                        'email' =>$input['email'],
                        'date' =>$input['udf2'],
                        'msg' =>$input['udf3'],
                        'status' => 'Pending',
                    ]);
            
                }

                $result = User::where('id',$input['udf5'])->first();
                Auth::login($result);
                $trxdtl=failtransction::where('payutxnid',$input['txnid'])->with('trxalacartorder')->first();
                $packagedtl = [];
                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
        }
        else if($input['status']=='success')
        {
            $ftrx=transction::where('payutxnid',$input['txnid'])->count();
                if($ftrx==0)
                {
                    $trxId=transction::insertGetId([
                        'trxdate' => $carb,
                        'subtotalamt' =>$input['udf1'],
                        'discountamt' =>'0',
                        'gstamt' => 0,
                        'deliveryamt' => '0',
                        'walletamt'=>$walletamt,
                        'payuamt'=>$payuamt,
                        'grandtotal' => $input['udf1'],
                        'finalamt' => $input['amount'],
                        'paymenId' => $input['mihpayid'],
                        'trxFor' => 'consultation',
                        'userId' => $input['udf5'],
                        'deliverystatus'=>'Pending',
                        'cpname' => $input['firstname'],
                        'cpno' => $input['phone'],
                        'trxStatus' =>$input['status'],
                        'mode'=>$input['mode'],
                        'payutxnid'=>$input['txnid'],
                        'reason'=>$input['field9'],
                        'errormsg'=>$input['error_Message'],
                    ]);

                    $cartlist=consultation::insertGetId([
                        'trxId' => $trxId,
                        'name' => $input['firstname'],
                        'number' =>$input['phone'],
                        'email' =>$input['email'],
                        'date' =>$input['udf2'],
                        'msg' =>$input['udf3'],
                        'status' => 'Pending',
                    ]);
            
                    $result = User::where('id',$input['udf5'])->first();
                    Auth::login($result);

                    $remark='Money Added for consultation booking #PKHK_'.$input['txnid'];
                    $this->creditAmount($input['udf5'], $payuamt, 0,$trxId,'consultation', $remark);

                    $remark='Paid for consultation booking #PKHK_'.$input['txnid'];
                    $this->debitAmount($input['udf5'],$input['udf1'], 0,$trxId,'consultation', $remark);

                    
                }
                $result = User::where('id',$input['udf5'])->first();
                Auth::login($result);
                $trxdtl=transction::where('payutxnid',$input['txnid'])->with('trxalacartorder')->first();
                $packagedtl = [];

                $this->sendEmail('ConsultationToUser', $input['email'], $result->name, $result->name, '', '', '', '', '', '' );
                $this->sendEmail('ConsultationToPoonam', 'poonamkapur77@gmail.com', 'Poonam Kapur', $input['email'], '', '', '', '', '', '' );

                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
        }
    }

    public function wallet()
    {
        if(Auth::user())
        {
            $categorylist = Category::where([['deleteId', '0'], ['status', '1']])->inRandomOrder()->limit('6')->get();
            $goallist = Goal::where([['deleteId', '0'], ['status', '1']])->with('package')->get();
            $packagelist = Package::where([['deleteId', '0'], ['status', '1']])->with('goal')->with('mealtype')->inRandomOrder()->limit('6')->get();
    
            $userdetail = User::where('id', Auth::user()->id)->first();
            $userwallet=Wallet::where('userId',Auth::user()->id)->first();
            $wallethistory=Walletremark::where('userId',Auth::user()->id)->orderBy('id','DESC')->get();
       
            $txnid = 'pk'.rand(99999, 9999999);

            return view('web.wallet', compact('userwallet','wallethistory','txnid','userdetail','categorylist', 'goallist','packagelist'));

        }
        else
        {
            return view('web.login');
        }
    }

    public function payuwalletresponsepkhk(Request $input)
    {
        // $input='{"mihpayid":"403993715528008394","mode":"UPI","status":"success","unmappedstatus":"failed","key":"gtKFFx","txnid":"pks4958426","amount":"100.00","discount":"0.00","net_amount_debit":"0.00","addedon":"2022-12-30 23:38:39","productinfo":"walletRecharge","firstname":"Sayed Zaid","lastname":null,"address1":null,"address2":null,"city":null,"state":null,"country":null,"zipcode":null,"email":"rishabh.2745@gmail.com","phone":"8433885667","udf1":"100","udf2":null,"udf3":null,"udf4":null,"udf5":"1","udf6":null,"udf7":null,"udf8":null,"udf9":null,"udf10":null,"hash":"f08d9f14b4daeb320a41088be06f3b65d378232a5a276c577a8af752445f2cf9e9d609f17725aca967c868d7224a6a50b1a1da207dab4fc3bf820b07003c6984","field1":"8976074007@ybl","field2":null,"field3":null,"field4":"RISHABH MAHENDRA KATARIYA","field5":null,"field6":null,"field7":null,"field8":null,"field9":"Transaction Failed at bank end.","payment_source":"payu","PG_TYPE":"HDFCU","bank_ref_num":null,"bankcode":"PP_UPI","error":"E308","error_Message":"Bank was unable to authenticate"}';
        // $input=json_decode($input,true);

        $carb= Carbon::now(); 

        if($input['status']=='failure')
        {
            $ftrx=failtransction::where('payutxnid',$input['txnid'])->count();
                if($ftrx==0)
                {
                    $trxId=failtransction::insertGetId([
                        'trxdate' => $carb,
                        'subtotalamt' =>$input['udf1'],
                        'discountamt' =>'0',
                        'gstamt' => 0,
                        'deliveryamt' => '0',
                        'walletamt'=>0,
                        'payuamt'=>$input['udf1'],
                        'grandtotal' =>$input['udf1'],
                        'finalamt' =>$input['udf1'],
                        'paymenId' => $input['mihpayid'],
                        'trxFor' => 'Wallet Recharge',
                        'userId' => $input['udf5'],
                        'cpname' => $input['firstname'],
                        'cpno' => $input['phone'],
                        'trxStatus' =>$input['status'],
                        'mode'=>$input['mode'],
                        'payutxnid'=>$input['txnid'],
                        'reason'=>$input['field9'],
                        'errormsg'=>$input['error_Message'],
                    ]);
                }

                $result = User::where('id',$input['udf5'])->first();
                Auth::login($result);
                
              return $this->wallet();
        }
        else if($input['status']=='success')
        {
            $ftrx=transction::where('payutxnid',$input['txnid'])->count();
                if($ftrx==0)
                {
                    $trxId=transction::insertGetId([
                        'trxdate' => $carb,
                        'subtotalamt' =>$input['udf1'],
                        'discountamt' =>'0',
                        'gstamt' => 0,
                        'deliveryamt' => '0',
                        'walletamt'=>0,
                        'payuamt'=>$input['udf1'],
                        'grandtotal' => $input['udf1'],
                        'finalamt' => $input['udf1'],
                        'paymenId' => $input['mihpayid'],
                        'trxFor' => 'Wallet Recharge',
                        'userId' => $input['udf5'],
                        'cpname' => $input['firstname'],
                        'cpno' => $input['phone'],
                        'trxStatus' =>$input['status'],
                        'mode'=>$input['mode'],
                        'payutxnid'=>$input['txnid'],
                        'reason'=>$input['field9'],
                        'errormsg'=>$input['error_Message'],
                    ]);

            
                    $result = User::where('id',$input['udf5'])->first();
                    Auth::login($result);

                    $remark='Money Added to wallet #PKHK_'.$input['txnid'];
                    $this->creditAmount($input['udf5'], $input['udf1'], 0,$trxId,'WalletRecharge', $remark);

                }

                

                return $this->wallet();
        }

    }

    public function trymod($txnid)
    {
        $trxdtl=failtransction::where('payutxnid',$txnid)->with('trxalacartorder')->first();
        $packagedtl = Package::where('id', 2)->with('goal')->with('mealtype')->first();
        return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
    }

    public function paywallet(Request $input)
    {
        // return $input->all();
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
                    $input['status']='success';
                }
                else
                {
                    
                    $payuamt=$trxdtl[5]-$walletamt;
                }
            }
            if($input['status']=='success')
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
        

                    $remark='Paid for alacart order #PKHK_'.$input['txnid'];
                    $this->debitAmount($input['udf5'],$trxdtl[5], 0,$trxId,'alacart', $remark);

                    cart::where('userID', $input['udf5'])->delete();
                }
                
                $result = User::where('id',$input['udf5'])->first();
                Auth::login($result);

                $trxdtl=transction::where('payutxnid',$input['txnid'])->with('trxalacartorder')->first();
                $packagedtl = [];

                // return $result;

                $this->sendEmail('OrderPlacedToUser', $result->email, $trxdtl->cpname, $trxdtl->cpname, $trxdtl->cpno, $result->email, $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );
                $this->sendEmail('OrderPlacedToPoonam', 'poonamkapur77@gmail.com', 'Poonam Kapur', $trxdtl->cpname, $trxdtl->cpno, $result->email, $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );

                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
            }
            else
            {
                $this->sendEmail('OrderFailedToPoonam', 'poonamkapur77@gmail.com','Poonam Kapur', $input->firstname, $input->phone, $input->email, '', $input->address1, $input->address2, $input->zipcode );
                return redirect()->back()->with('error', 'Something went wrong !');

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
                    $input['status']='success';
                }
                else
                {
                    $payuamt=$trxdtl[5]-$walletamt;
                }
            }

            if($input['status']=='success')
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

                    $remark='Locked for subscription order #PKHK_'.$input['txnid'];
                    $this->lockamount($input['udf5'], $trxdtl[5], $trxdtl[5],$trxId,'subscription', $remark);
                }
                $result = User::where('id',$input['udf5'])->first();
                Auth::login($result);
                $trxdtl=transction::where('payutxnid',$input['txnid'])->with('trxalacartorder')->first();
                $packagedtl = Package::where('id', $pkgdtl[0])->with('goal')->with('mealtype')->first();
                
                // return $trxdtl;

                $this->sendEmail('SubscribedToUser', $result->email, $trxdtl->cpname, $trxdtl->cpname, $trxdtl->cpno, $result->email, $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );
                // not working
                $this->sendEmail('SubscribedToPoonam', 'szaid444666@gmail.com', 'Poonam Kapur', $trxdtl->cpname, $trxdtl->cpno, $result->email, $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );

                return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
            }
            else
            {
                return redirect()->back()->with('error', 'Something went wrong !');
            }
        }
        else if($input['productinfo']=='consultation')
        {
            $carb= Carbon::now(); 

            $trxdtl=explode (",", $input['udf1']);

            $walletamt=0;
            $payuamt=0;
            if ($input['udf4']=='0')
            {
                $walletamt=0;
                $payuamt=$input['udf4'];
            }
            else if($input['udf4']=='1')
            {
                $walletamt=Wallet::where('userId',$input['udf5'])->first();
                $walletamt=$walletamt['availableBal'];
                if($walletamt>=$input['udf1'])
                {
                    $walletamt=$input['udf1'];
                    $payuamt=0;
                    $input['status']='success';
                }
                else
                {
                    $payuamt=$input['udf1']-$walletamt;
                }
            }
            if($input['status']=='success')
            {
                $ftrx=transction::where('payutxnid',$input['txnid'])->count();
                    if($ftrx==0)
                    {
                        $trxId=transction::insertGetId([
                            'trxdate' => $carb,
                            'subtotalamt' =>$input['udf1'],
                            'discountamt' =>'0',
                            'gstamt' => 0,
                            'deliveryamt' => '0',
                            'walletamt'=>$walletamt,
                            'payuamt'=>$payuamt,
                            'grandtotal' => $input['udf1'],
                            'finalamt' => $input['amount'],
                            'paymenId' => $input['mihpayid'],
                            'trxFor' => 'consultation',
                            'userId' => $input['udf5'],
                            'deliverystatus'=>'Pending',
                            'cpname' => $input['firstname'],
                            'cpno' => $input['phone'],
                            'trxStatus' =>$input['status'],
                            'mode'=>$input['mode'],
                            'payutxnid'=>$input['txnid'],
                            'reason'=>$input['field9'],
                            'errormsg'=>$input['error_Message'],
                        ]);

                        $cartlist=consultation::insertGetId([
                            'trxId' => $trxId,
                            'name' => $input['firstname'],
                            'number' =>$input['phone'],
                            'email' =>$input['email'],
                            'date' =>$input['udf2'],
                            'msg' =>$input['udf3'],
                            'status' => 'Pending',
                        ]);

                        $result = User::where('id',$input['udf5'])->first();
                        Auth::login($result);

                        $remark='Paid for consultation booking #PKHK_'.$input['txnid'];
                        $this->debitAmount($input['udf5'],$input['udf1'], 0,$trxId,'consultation', $remark);
                    }
                    $result = User::where('id',$input['udf5'])->first();
                    Auth::login($result);
                    $trxdtl=transction::where('payutxnid',$input['txnid'])->with('trxalacartorder')->first();
                    $packagedtl = [];
                    $this->sendEmail('ConsultationToUser', $input['email'], $trxdtl->cpname, $trxdtl->cpname, $trxdtl->cpno, $input['email'], $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );
                    $this->sendEmail('ConsultationToPoonam', 'poonamkapur77@gmail.com', 'Poonam Kapur', $trxdtl->cpname, $trxdtl->cpno, $input['email'], $trxdtl->id, $trxdtl->address, $trxdtl->area, $trxdtl->pincode );

                    return view('web.alacartsuccess')->with(['trxdtl'=>$trxdtl,'packagedtl'=>$packagedtl]);
            }
        }
        
    }

    // email function

    public function sendEmail($type, $receiverEmail, $receiverName, $username, $phone, $email, $trxId, $address, $area, $pincode )
    {
        if($type == 'BulkToPoonam')
        {
            $name = 'GRISHMA FOODS PRIVATE LIMITED';
            $subject = 'Enquiry For Bulk Order';
            $body = '<html><head></head><body><p>Hello Poonam Maam,</p> <br>You have received a Bulk Enquiry from '.$username.'.<br>You can contact the user by: <br> <b> Call: </b> '.$phone.'<br> <b>Email : </b> '.$email.' </p><br><br>For more information <a href="https://poonamkapur.com/enquiry/bulk" target="_blank">Click Here</a> <br></body></html>';
        } 
        else if($type == 'BulkToUser')
        {
            $name = 'GRISHMA FOODS PRIVATE LIMITED';
            $subject = 'Enquiry For Bulk Order';
            $body = '<html><head></head><body><p>Hello '.$username.',</p>Thank you for your interest in our Bulk Orders. We have received your request and our representative will get back to you shortly.<br>Incase the request is urgent you can give us a call on +91-98200-97377.<br> Appreciate your patience.</p><br><br><br><br>Regards<br>Team GRISHMA FOODS PRIVATE LIMITED</body></html>';
        }
        else if($type == 'FranchiseToPoonam')
        {
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Enquiry For Franchise Order';
            $body = '<html><head></head><body><p>Hello Poonam Maam,</p> <br>You have received a Franchise Enquiry from '.$username.'.<br>You can contact the user by: <br> <b> Call: </b> '.$phone.'<br> <b>Email : </b> '.$email.' </p><br><br>For more information <a href="https://poonamkapur.com/enquiry/franchise" target="_blank">Click Here</a><br></body></html>';
        }
        else if($type == 'FranchiseToUser')
        {
            error_log("FranchiseToUser");
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Enquiry For Franchise Order';
            $body = '<html><head></head><body><p>Hello '.$username.',</p>Thank you for your interest in our Franchise Enquiry. We have received your request and our representative will get back to you shortly.<br>Incase the request is urgent you can give us a call on +91-98200-97377.<br> Appreciate your patience.</p><br><br><br><br>Regards<br>Team GRISHMA FOODS PRIVATE LIMITED</body></html>';
        }
        else if($type == 'ConsultationToPoonam')
        {
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Consultation Request';
            $body = '<html><head></head><body><p>Hello Poonam Maam,</p> <br>You have received a Consultation Request from '.$username.'.<br>You can contact the user by: <br> <b> Call: </b> '.$phone.'<br> <b>Email : </b> '.$email.' </p><br><br>For more information <a href="https://poonamkapur.com/booking" target="_blank">Click Here</a><br></body></html>';
        }
        else if($type == 'ConsultationToUser')
        {
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Consultation Request';
            $body = '<html><head></head><body><p>Hello '.$username.',</p>We have received your consultation request and our dietician will contact you on the choosen date.</p><br><br><br><br>Regards<br>Team GRISHMA FOODS PRIVATE LIMITED</body></html>';
        }
        else if($type == 'OrderPlacedToPoonam')
        {
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Order Placed';
            $body = '<html><head></head><body><p>Hello Poonam Maam,</p> <br>You have received a Order from '.$username.'.<br>You can check the order details on <a href="https://poonamkapur.com/order/alacart" target="_blank"> Here </a> or you can contact the user by: <br> <b> Call: </b> '.$phone.'<br> <b>Email : </b> '.$email.' </p><br><br><br></body></html>';
        }
        else if($type == 'OrderPlacedToUser')
        {
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Order Placed';
            $body = '<html><head></head><body><p>Hello '.$username.',</p>We have received your order <b>#'.$trxId.' .</b> <br> <b>From:</b> '.$address.', '.$area.', '.$pincode.' </p><br>Thank you for your order, and we look forward to serving you again soon.<br>To see your order details <a href="https://poonamkapur.com/app/myprofile" target="_blank"> Click Here </a> </p><br><br><br><br>Regards<br>Team GRISHMA FOODS PRIVATE LIMITED</body></html>';
        }
        else if($type == 'OrderFailedToPoonam')
        {
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Order Failed';
            $htmlContent = '<html><head></head><body><p>Hello Poonam Maam,</p> <br>An Order have failed from '.$username.'.<br>You can contact the user by: <br> <b> Call: </b> '.$phone.'<br> <b>Email : </b> '.$email.' </p><br><br><br></body></html>';
        }
        else if($type == 'SubscribedToPoonam')
        {
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Subscribed';
            $body = '<html><head></head><body><p>Hello Poonam Maam,</p> <br>You have received a Subscription from '.$username.'.<br> You can check the order details on <a href="https://poonamkapur.com/order/package" target="_blank"> Here </a> or you can contact the user by: <br> <b> Call: </b> '.$phone.'<br> <b>Email : </b> '.$email.' </p><br><br><br></body></html>';
        }
        else if($type == 'SubscribedToUser')
        {
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Subscribed';
            $body = '<html><head></head><body><p>Hello '.$username.',</p>Thank you for your interest in our Subscription. We have confirmed your subscription, We hope that you love our food.<br>To see your order details <a href="https://poonamkapur.com/app/myprofile" target="_blank"> Click Here </a> <br>Incase you have any query, give us a call at +91-98200-97377.</p><br><br><br><br>Regards<br>Team GRISHMA FOODS PRIVATE LIMITED</body></html>';
        } 
        else if($type == "ForgetPassword")
        {
            $name = "Welcome To GRISHMA FOODS PRIVATE LIMITED";
            $subject = 'Forget Password';
            $body = '<html><head></head><body><p>Hello '.$username.',</p> <br> You have requested for a password reset. Please click on the link below to reset your password. <br> <a href="https://poonamkapur.com/app/resetpassword/'.$address.'""> Reset Password </a> </p><br><br><br></body></html>';
        }
        

        $data = array(
            "sender" => array(
                "email" => 'poonamkapur77@gmail.com',
                "name" => 'GRISHMA FOODS PRIVATE LIMITED'
            ),
            "to" => array(
                array(
                    "email" => $receiverEmail,
                    "name" => $receiverName
                    )
                ),
            "name" => $name,
            "subject" => $subject,
            "htmlContent" => $body
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sendinblue.com/v3/smtp/email',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Api-Key: '. env('SENDINBLUE_API_KEY')
            ),
        ));
        // $response = curl_exec($curl);
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
        }
        error_log('this comes ->'.$result);
        curl_close($curl);
    }
}
