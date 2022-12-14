<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\alacartorder;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Booking;
use App\Models\Category;
use App\Models\consultation;
use App\Models\Coupon;
use App\Models\Enquiry;
use App\Models\Enquirybulk;
use App\Models\Enquiryfranchise;
use App\Models\failtransction;
use App\Models\Faq;
use App\Models\Goal;
use App\Models\Inventoryhistory;
use App\Models\Log;
use App\Models\Mealtime;
use App\Models\Mealtype;
use App\Models\Package;
use App\Models\Packagemenu;
use App\Models\Pincode;
use App\Models\Product;
use App\Models\Productmacro;
use App\Models\Productreceipe;
use App\Models\Rawmaterial;
use App\Models\Rawmateriallog;
use App\Models\Review;
use App\Models\Role;
use App\Models\Subcategory;
use App\Models\Subscriptionkt;
use App\Models\subscriptionorder;
use App\Models\Testimonial;
use App\Models\transction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Walletremark;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
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

class AdminController extends Controller
{

    // cron job functions
    function dailySubscriptionKt()
    {

        $getSubscriptionTrx = transction::where('trxFor', 'subscription')->pluck('id')->toArray();
        $today = Carbon::now()->format('d');
        $getActiveSubscriptions = subscriptionorder::whereIn('trxId', $getSubscriptionTrx)->where('status', 'Booked')->with(['pkgdtl' => function ($query) use ($today) {
            $query->with(['packagemenu' => function ($query) use ($today) {
                $query->where('day', $today);
            }]);
        }])->get();
        foreach ($getActiveSubscriptions as $subscription) {
            return $subscription;
            $completedMealCount = Subscriptionkt::where('status', 'Completed')->where('userId', $subscription->userId)->count();
            $mealTimeSubscribed = $subscription->subscribedfor;
            $mealTimeSubscribed = explode(',', $mealTimeSubscribed);
            $getSubscriptionKt = $subscription->pkgdtl->packagemenu;
            return $getSubscriptionKt;
            foreach ($getSubscriptionKt as $kt) {
                if ($completedMealCount == $subscription->totalmeal) {
                    $changeStatus = subscriptionorder::where('userId', $subscription->userId)->first();
                    $changeStatus->status = 'Completed';
                    $changeStatus->update();
                } else {
                    if ($subscription->status == 'Booked') {
                        if (in_array('BreakFast', $mealTimeSubscribed)) {
                            $getProduct = Product::where('UID', $kt->breakFast)->select('UID', 'name', 'image')->first();
                            // return $getProduct;
                            // return $subscription->pkgdtl->bfPrice;
                            $addToSubsKt = new Subscriptionkt();
                            $addToSubsKt->trxId = $subscription->trxId;
                            $addToSubsKt->subOdrId = $subscription->id;
                            $addToSubsKt->userId = $subscription->userId;
                            $addToSubsKt->productId = $getProduct->UID;
                            $addToSubsKt->productName = $getProduct->name;
                            $addToSubsKt->productImage = $getProduct->image;
                            $addToSubsKt->mealTime = 'Breakfast';
                            $addToSubsKt->mealPrice = $subscription->pkgdtl->bfPrice;
                            $addToSubsKt->status = 'Pending';
                            $addToSubsKt->save();
                        }
                        if (in_array('Lunch', $mealTimeSubscribed)) {
                            $getProduct = Product::where('UID', $kt->lunch)->select('UID', 'name', 'image')->first();
                            $addToSubsKt = new Subscriptionkt();
                            $addToSubsKt->trxId = $subscription->trxId;
                            $addToSubsKt->subOdrId = $subscription->id;
                            $addToSubsKt->userId = $subscription->userId;
                            $addToSubsKt->productId = $getProduct->UID;
                            $addToSubsKt->productName = $getProduct->name;
                            $addToSubsKt->productImage = $getProduct->image;
                            $addToSubsKt->mealTime = 'Lunch';
                            $addToSubsKt->mealPrice = $subscription->pkgdtl->lPrice;
                            $addToSubsKt->status = 'Pending';
                            $addToSubsKt->save();
                        }
                        if (in_array('Snack', $mealTimeSubscribed)) {
                            $getProduct = Product::where('UID', $kt->snack)->select('UID', 'name', 'image')->first();
                            $addToSubsKt = new Subscriptionkt();
                            $addToSubsKt->trxId = $subscription->trxId;
                            $addToSubsKt->subOdrId = $subscription->id;
                            $addToSubsKt->userId = $subscription->userId;
                            $addToSubsKt->productId = $getProduct->UID;
                            $addToSubsKt->productName = $getProduct->name;
                            $addToSubsKt->productImage = $getProduct->image;
                            $addToSubsKt->mealTime = 'Snack';
                            $addToSubsKt->mealPrice = $subscription->pkgdtl->sPrice;
                            $addToSubsKt->status = 'Pending';
                            $addToSubsKt->save();
                        }
                        if (in_array('Dinner', $mealTimeSubscribed)) {
                            $getProduct = Product::where('UID', $kt->dinner)->select('UID', 'name', 'image')->first();
                            $addToSubsKt = new Subscriptionkt();
                            $addToSubsKt->trxId = $subscription->trxId;
                            $addToSubsKt->subOdrId = $subscription->id;
                            $addToSubsKt->userId = $subscription->userId;
                            $addToSubsKt->productId = $getProduct->UID;
                            $addToSubsKt->productName = $getProduct->name;
                            $addToSubsKt->productImage = $getProduct->image;
                            $addToSubsKt->mealTime = 'Dinner';
                            $addToSubsKt->mealPrice = $subscription->pkgdtl->dPrice;
                            $addToSubsKt->status = 'Pending';
                            $addToSubsKt->save();
                        }
                    }
                }
            }
        }
        return 'completed';
    }
    // end cron job functions

    function manageInventory($productUID, $orderType)
    {
        $product = Product::where('UID', $productUID)->with('recipe')->first();
        foreach ($product->recipe as $recipe) {
            // return $recipe;
            $rawmaterial = Rawmaterial::where('UID', $recipe->rawMaterialUId)->first();
            $rawmaterial->stock -= $recipe->quantity;
            $rawmaterial->update();

            $rawmaterialLog = new Inventoryhistory();
            $rawmaterialLog->forProduct = $productUID;
            $rawmaterialLog->orderType = $orderType;
            $rawmaterialLog->item = $rawmaterial->UID;
            $rawmaterialLog->action = 'Consumed';
            $rawmaterialLog->quantity = $recipe->quantity;
            $rawmaterialLog->date = date('Y-m-d');
            $rawmaterialLog->save();
        }
    }

    // Log controllers

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

    public function indexLog()
    {
        $logs = Log::with('user')->orderBy('id', 'desc')->get();
        return view('admin.log', compact('logs'));
    }

    public function indexAdmin()
    {
        $endusers = User::where('deleteId', '0')->where('role', '5')->orWhere('role', '6')->orWhere('role', '7')->count();
        return view('admin.dashboard', compact('endusers'));
    }

    public function indexHompage()
    {
        return view('homepage.home');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function Register(Request $request)
    {
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/login');
    }

    public function showforget(Request $request)
    {
        return view('forgetpassword');
    }

    public function forgetpassword(Request $request)
    {
        $user = User::where('phone', $request->phone)->count();

        if ($user == 0) {
            return response()->json([
                'status' => 201,
                'message' => 'No User with this number',
            ]);
        }
        // Session()->flash('alert-success', "Otp Sent!!");
        // return redirect()->back();

        return response()->json([
            'status' => 200,

        ]);
    }

    public function changepassword(Request $request)
    {

        $user = User::where('phone', $request->phone)->first();
        $user->password = Hash::make($request->pass);
        $user->update();
        return response()->json([
            'status' => 200,
            'message' => 'Password Changed Successfully',
        ]);
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {

            return view('login');
            Session()->flash('alert-success', "Please Login in First");
        }
        return view('login');
    }

    public function checkUser(Request $request)
    {
        // return $request;
        $phone = $request->post('login');
        $email = $request->post('login');

        $result = User::where(['phone' => $phone])
            ->orWhere(['email' => $email])
            ->first();

        if ($result) {
            if ($result->status == 1 && $result->deleteId == 0) {
                if (Hash::check($request->post('password'), $result->password)) {
                    Auth::login($result);
                    // return redirect('dashboard');
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

    public function checkPhone(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            return response()->json([
                'status' => 201,
                'message' => 'User Found',
            ]);
        }
    }

    public function checkPass(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if (Hash::check($request->oldpass, $user->password)) {
            return response()->json([
                'status' => 201,
                'message' => 'User Found',
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'User not Found',
            ]);
        }
    }

    public function logout()
    {
        $this->storeLog('Logout', 'Logout', Auth::user()->id);
        Auth::logout();
        return redirect('/login');
    }

    // Office User Controller

    public function indexUser()
    {
        $user = User::where('deleteId', '0')->whereIn('role', [1])->with('rolee')->get();
        $roles = Role::where('deleteId', '0')->whereIn('id', [1])->get();
        return view('admin.user', compact('user', 'roles'));
    }

    public function checkOfficeUserEmail(Request $request)
    {
        $data = User::where('email', $request->email)->where('deleteId', 0)->first();
        if ($data) {
            return response()->json([
                'status' => 201,
                'message' => 'Email Already Exist',
            ]);
        }
    }

    public function checkOfficeUserPhone(Request $request)
    {
        $data = User::where('phone', $request->phone)->where('deleteId', 0)->first();
        if ($data) {
            return response()->json([
                'status' => 201,
                'message' => 'Phone Already Exist',
            ]);
        }
    }

    public function checkGoalName(Request $request)
    {
        $data = Goal::where('name', $request->name)->where('deleteId', 0)->first();
        if ($data) {
            return response()->json([
                'status' => 201,
                'message' => 'Goal Already Exist',
            ]);
        }
    }

    public function saveUser(Request $request)
    {

        $user = new User;

        $uploadpath = 'media/images/users';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/users/' . $final_name, 0777);
            $image_path = "media/images/users/" . $final_name;
        } else {
            $image_path = "";
        }

        $user->profileImage = $image_path;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();
        Session()->flash('alert-success', "User Added Succesfully");
        $this->storeLog('Add', 'saveUser', $user);
        return redirect()->back();
    }

    public function exportToCSV()
    {
        $data = User::all();
        $handle = fopen('export.csv', 'w');
        // fputcsv($handle, array('id', 'name', 'email', 'phone', 'role', 'status', 'created_at', 'updated_at'));
        User::chunk(100, function ($users) use ($handle) {
            foreach ($users as $row) {
                fputcsv($handle, $row->toArray(), ';');
            }
        });
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        $this->storeLog('Add', 'exportToCSV', '-');
        return response()->download('export.csv', 'export.csv', $headers);
    }

    public function ExportOfficeUserExcel($OfficeUser_data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($OfficeUser_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="OfficeUsers_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function exportOfficeUserData()
    {
        $this->storeLog('Export', 'exportOfficeUserData', '-');
        $data = User::orderBy('id', 'DESC')->get();
        $data_array[] = array("Id", "Name", "Phone", "Email", "Role", "Status", "Created At", "Updated At");
        foreach ($data as $data_item) {
            if ($data_item->status == 1) {
                $status = 'Active';
            } else {
                $status = 'Inactive';
            }
            $data_array[] = array(
                'Id' => $data_item->id,
                'Name' => $data_item->name,
                'Phone' => $data_item->phone,
                'Email' => $data_item->email,
                'Role' => $data_item->rolee->name,
                'Status' => $status,
                'Created At' => $data_item->created_at,
                'Updated At' => $data_item->updated_at,
            );
        }
        $this->ExportOfficeUserExcel($data_array);
    }

    public function saveUserExcel(Request $request)
    {
        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/User/';
            $filepath = 'storage/ExcelFiles/User/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/User/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $counter = 0;
            $failed = 0;
            foreach ($rowData as $value) {

                if (empty($value)) {
                    $counter--;
                } else {
                    $fieldData = new User();  //name of modal
                    $fieldData->name = $value[0];  //name of database feild = colm no in xls
                    $fieldData->dob = $value[1];
                    $fieldData->address = $value[2];
                    $fieldData->phone = $value[3];
                    $fieldData->email = $value[4];
                    $fieldData->password = Hash::make($value[5]);
                    $fieldData->aadhar = $value[6];
                    $fieldData->esicNumber = $value[7];
                    $fieldData->pfNumber = $value[8];
                    $fieldData->role = $value[9];
                    $fieldData->notes = $value[10];
                    $fieldData->siteId = $value[11];
                    $fieldData->dependents = $value[12];
                    $fieldData->skillLevel = $value[13];
                    $fieldData->maxTicketsPerDay = $value[14];
                    $fieldData->save();
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully");
            $this->storeLog('Add', 'saveUserExcel', $fieldData);
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    public function deleteUser(Request $request)
    {
        $model = User::find($request->hiddenId);
        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "User Deleted Succesfully");
        $this->storeLog('Delete', 'deleteUser', $model);
        return redirect()->back();
    }

    public function updateUser(Request $request)
    {
        $model = User::find($request->hiddenId);

        $uploadpath = 'media/images/users';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/users/' . $final_name, 0777);
            $image_path = "media/images/users/" . $final_name;
        } else {
            $image_path = User::where('id', $request->hiddenId)->first();
            $image_path = $image_path['image'];
        }

        $model->profileImage = $image_path;
        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->role = $request->role;
        $model->status = $request->status;
        $model->update();
        Session()->flash('alert-success', "User Updated Succesfully");
        $this->storeLog('Update', 'updateUser', $model);

        return redirect()->back();
    }

    public function userStatus(Request $request)
    {
        $model = User::find($request->user_id);
        $model->status = $request->status;
        $model->save();
        $this->storeLog('User', 'userStatus', $model);

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // Enduser controller

    public function indexEnduser()
    {
        $enduser = User::where('deleteId', '0')->whereIn('role', ['2'])->get();
        // return $user;
        $roles = Role::where('deleteId', '0')->whereIn('id', ['2'])->get();
        return view('admin.enduser', compact('enduser', 'roles'));
    }

    public function enduserStatus(Request $request)
    {
        $model = User::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    public function checkEndUserEmail(Request $request)
    {
        $data = User::where('email', $request->email)->where('deleteId', 0)->first();
        if ($data) {
            return response()->json([
                'status' => 201,
                'message' => 'Email Already Exist',
            ]);
        }
    }

    public function checkEndUserPhone(Request $request)
    {
        $data = User::where('phone', $request->phone)->where('deleteId', 0)->first();
        if ($data) {
            return response()->json([
                'status' => 201,
                'message' => 'Phone Already Exist',
            ]);
        }
    }

    public function saveEnduser(Request $request)
    {
        $request->validate([
            'phone' => 'unique:users',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        // Mail::->to($user->email)->send(new TestEmail());

        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();
        Session()->flash('alert-success', "User Added Succesfully");
        $this->storeLog('Add', 'saveEnduser', $user);
        return redirect()->back();
    }

    public function deleteEnduser(Request $request)
    {
        $model = User::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "User Deleted Succesfully");
        $this->storeLog('Delete', 'deleteEnduser', $model);
        return redirect()->back();
    }

    public function updateEnduser(Request $request)
    {
        $model = User::find($request->hiddenId);

        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->age = $request->age;
        $model->role = $request->role;
        $model->status = $request->status;
        $model->update();
        Session()->flash('alert-success', "User Updated Succesfully");
        $this->storeLog('Update', 'updateEnduser', $model);
        return redirect()->back();
    }

    public function filterEndUser(Request $request)
    {
        $roles = Role::where('deleteId', '0')->where('status', 'active')->where('id', '5')->orWhere('id', '6')->orWhere('id', '7')->get();
        $model = User::query();
        $formid = $request['id'];
        $formname = $request['name'];
        $formemail = $request['email'];
        $formphone = $request['phone'];
        $formrole = $request['role'];
        $formstatus = $request['status'];

        $user = User::where('deleteId', '0')->where('role', '5')->orWhere('role', '6')->orWhere('role', '7')->when($formid, function ($model) use ($formid) {
            return $model->where('id', $formid);
        })->when($formname, function ($model) use ($formname) {
            return $model->where('name', $formname);
        })->when($formemail, function ($model) use ($formemail) {
            return $model->where('email', $formemail);
        })->when($formphone, function ($model) use ($formphone) {
            return $model->where('phone', $formphone);
        })->when($formrole, function ($model) use ($formrole) {
            return $model->where('role', $formrole);
        })->when($formstatus, function ($model) use ($formstatus) {
            return $model->where('status', $formstatus);
        })->get();


        return view('admin.enduser', compact('user', 'roles'));
    }

    // Reset Pass Controller

    public function resetPassIndex()
    {
        return view('resetPass');
    }

    public function resetPass(Request $request)
    {
        $model = User::where(['phone' => $request->phone])->first();

        if (Hash::check($request->oldpass, $model->password)) {
            if ($request->newpass == $request->confirmpass) {
                $model->password = Hash::make($request->newpass);
                $model->update();
                Auth::logout();
                return redirect('/login');
            }
        }
    }


    // Role Controller

    public function indexRole()
    {
        $roles = Role::where('deleteId', '0')->get();
        return view('admin.role', compact('roles'));
    }

    public function storeRole(Request $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();
        Session()->flash('alert-success', "Role Added Succesfully");
        $this->storeLog('Add', 'storeRole', $role);
        return redirect()->back();;
    }

    public function updateRole(Request $request)
    {
        $role = Role::find($request->hiddenId);
        $role->name = $request->name;
        $role->status = $request->status;
        $role->update();
        Session()->flash('alert-success', "Role Updated Succesfully");
        $this->storeLog('Update', 'updateRole', $role);
        return redirect()->back();;
    }

    public function deleteRole(Request $request)
    {
        $model = Role::find($request->hiddenId);
        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Role Updated Succesfully");
        $this->storeLog('Delete', 'deleteRole', $model);
        return redirect()->back();;
    }

    // Category Controller

    public function indexCategory()
    {
        $categories = Category::where('deleteId', '0')->get();
        return view('admin.category', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $category = new Category;
        // image upload
        $uploadpath = 'media/images/category';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/category/' . $final_name, 0777);
            $image_path = "media/images/category/" . $final_name;
        } else {
            $image_path = null;
        }
        $category->image = $image_path;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();
        Session()->flash('alert-success', "Category Added Succesfully");
        $this->storeLog('Add', 'storeCategory', $category);
        return redirect()->back();
    }

    public function updateCategory(Request $request)
    {
        $category = Category::find($request->hiddenId);
        // image upload
        $uploadpath = 'media/images/category';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/category/' . $final_name, 0777);
            $image_path = "media/images/category/" . $final_name;
        } else {
            $image_path = Blog::where('id', $request->hiddenId)->first();
            $image_path = $image_path['image'];
        }
        $category->image = $image_path;
        $category->name = $request->name;
        $category->description = $request->description;
        if ($request->status != $category->status) {
            $category->status = $request->status;
            Subcategory::where('categoryId', $request->hiddenId)->update(['status' => $request->status]);
        }
        $category->update();
        Session()->flash('alert-success', "Category Updated Succesfully");
        $this->storeLog('Update', 'updateCategory', $category);
        return redirect()->back();
    }

    public function deleteCategory(Request $request)
    {
        $model = Category::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Category Updated Succesfully");
        $this->storeLog('Delete', 'deleteCategory', $model);
        return redirect()->back();;
    }

    public function categoryStatus(Request $request)
    {
        $model = Category::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // subcategory Controller

    public function indexSubcategory()
    {
        $subcategories = Subcategory::where('deleteId', '0')->with('category')->orderBy('id', 'Desc')->get();
        $categories = Category::where('deleteId', '0')->get();
        return view('admin.subcategory', compact('subcategories', 'categories'));
    }

    public function storeSubcategory(Request $request)
    {
        $subcategory = new Subcategory;
        // image upload
        $uploadpath = 'media/images/subcategory';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/subcategory/' . $final_name, 0777);
            $image_path = "media/images/subcategory/" . $final_name;
        } else {
            $image_path = null;
        }
        $subcategory->image = $image_path;
        $subcategory->categoryId = $request->categoryId;
        $subcategory->name = $request->name;
        $subcategory->description = $request->description;
        $subcategory->status = $request->status;
        $subcategory->save();
        Session()->flash('alert-success', "Subcategory Added Succesfully");
        $this->storeLog('Add', 'storeSubcategory', $subcategory);

        return redirect()->back();;
    }

    public function updateSubcategory(Request $request)
    {
        $subcategory = Subcategory::find($request->hiddenId);
        // image upload
        $uploadpath = 'media/images/subcategory';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/subcategory/' . $final_name, 0777);
            $image_path = "media/images/subcategory/" . $final_name;
        } else {
            $image_path = Subcategory::where('id', $request->hiddenId)->first();
            $image_path = $image_path['image'];
        }
        $subcategory->image = $image_path;
        $subcategory->categoryId = $request->categoryId;
        $subcategory->name = $request->name;
        $subcategory->description = $request->description;
        if ($request->status != $subcategory->status) {
            $subcategory->status = $request->status;
        }
        $subcategory->update();
        Session()->flash('alert-success', "Subcategory Updated Succesfully");
        $this->storeLog('Update', 'updateSubcategory', $subcategory);
        return redirect()->back();;
    }

    public function deleteSubcategory(Request $request)
    {
        $model = Subcategory::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Subcategory Updated Succesfully");
        $this->storeLog('Delete', 'deleteSubcategory', $model);
        return redirect()->back();;
    }

    public function subcategoryStatus(Request $request)
    {
        $model = Subcategory::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // mealType Controller

    public function indexMealType()
    {
        $mealTypes = Mealtype::where('deleteId', '0')->get();
        return view('admin.mealType', compact('mealTypes'));
    }

    public function storeMealType(Request $request)
    {
        $mealType = new Mealtype;
        $mealType->name = $request->name;
        $mealType->status = $request->status;
        $mealType->save();
        Session()->flash('alert-success', "MealType Added Succesfully");
        $this->storeLog('Add', 'storeMealType', $mealType);

        return redirect()->back();;
    }

    public function updateMealType(Request $request)
    {
        $mealType = Mealtype::find($request->hiddenId);
        $mealType->name = $request->name;
        $mealType->status = $request->status;
        $mealType->update();
        Session()->flash('alert-success', "MealType Updated Succesfully");
        $this->storeLog('Update', 'updateMealType', $mealType);
        return redirect()->back();;
    }

    public function deleteMealType(Request $request)
    {
        $model = Mealtype::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "MealType Updated Succesfully");
        $this->storeLog('Delete', 'deleteMealType', $model);
        return redirect()->back();;
    }

    public function mealTypeStatus(Request $request)
    {
        $model = Mealtype::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // goal controller

    public function indexGoal()
    {
        $goals = Goal::where('deleteId', '0')->get();
        return view('admin.goal', compact('goals'));
    }

    public function storeGoal(Request $request)
    {
        $goal = new Goal;
        // image upload
        $uploadpath = 'media/images/goal';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/goal/' . $final_name, 0777);
            $image_path = "media/images/goal/" . $final_name;
        } else {
            $image_path = null;
        }
        $goal->image = $image_path;
        $goal->name = $request->name;
        $goal->description = $request->description;
        $goal->status = $request->status;
        $goal->save();
        Session()->flash('alert-success', "Goal Added Succesfully");
        $this->storeLog('Add', 'storeGoal', $goal);

        return redirect()->back();;
    }

    public function updateGoal(Request $request)
    {
        $goal = Goal::find($request->hiddenId);
        // image upload
        $uploadpath = 'media/images/goal';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/goal/' . $final_name, 0777);
            $image_path = "media/images/goal/" . $final_name;
        } else {
            $image_path = Goal::where('id', $request->hiddenId)->first();
            $image_path = $image_path['image'];
        }
        $goal->image = $image_path;
        $goal->name = $request->name;
        $goal->description = $request->description;
        if ($request->status != $goal->status) {
            $goal->status = $request->status;
        }
        $goal->update();
        Session()->flash('alert-success', "Goal Updated Succesfully");
        $this->storeLog('Update', 'updateGoal', $goal);
        return redirect()->back();;
    }

    public function deleteGoal(Request $request)
    {
        $model = Goal::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Goal Updated Succesfully");
        $this->storeLog('Delete', 'deleteGoal', $model);
        return redirect()->back();;
    }

    public function goalStatus(Request $request)
    {
        $model = Goal::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // Raw material

    public function indexRawMaterial()
    {
        $rawmaterials = Rawmaterial::where('deleteId', '0')->get();
        return view('admin.rawmaterial', compact('rawmaterials'));
    }

    public function storeRawMaterial(Request $request)
    {
        $rawMaterial = new Rawmaterial;
        $rawMaterial->UID = $request->UID;
        $rawMaterial->name = $request->name;
        $rawMaterial->unit = $request->unit;
        $rawMaterial->warnAt = $request->warn;
        $rawMaterial->status = $request->status;
        $rawMaterial->save();
        Session()->flash('alert-success', "Raw Material Added Succesfully");
        $this->storeLog('Add', 'storeRawMaterial', $rawMaterial);

        return redirect()->back();;
    }

    public function updateRawMaterial(Request $request)
    {
        $rawMaterial = Rawmaterial::find($request->hiddenId);
        $rawMaterial->name = $request->name;
        $rawMaterial->unit = $request->unit;
        $rawMaterial->warnAt = $request->warn;
        if ($request->status != $rawMaterial->status) {
            $rawMaterial->status = $request->status;
        }
        $rawMaterial->update();
        Session()->flash('alert-success', "Raw Material Updated Succesfully");
        $this->storeLog('Update', 'updateRawMaterial', $rawMaterial);
        return redirect()->back();;
    }

    public function importRawMaterial(Request $request)
    {
        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/RawMaterial/';
            $filepath = 'storage/ExcelFiles/RawMaterial/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/RawMaterial/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $counter = 0;
            $failed = 0;
            foreach ($rowData as $value) {

                if (empty($value)) {
                    $counter--;
                } else {
                    $product = Rawmaterial::where('UID', $value[0])->first();
                    if ($product) {
                        $failed++;
                        continue;
                    } else {
                        $fieldData = new Rawmaterial();  //name of modal
                        $fieldData->UID = $value[0];
                        $fieldData->name = $value[1];
                        $fieldData->unit = $value[2];
                        $fieldData->warnAt = $value[3];
                        if ($value[4] == 'Active') {
                            $fieldData->status = 1;
                        } else {
                            $fieldData->status = 0;
                        }
                        $fieldData->save();
                    }
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully");
            // $this->storeLog('Add', 'importProduct', $fieldData);
            // delete excel file
            unlink($filepath);
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    public function deleteRawMaterial(Request $request)
    {
        $model = Rawmaterial::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Raw Material Updated Succesfully");
        $this->storeLog('Delete', 'deleteRawMaterial', $model);
        return redirect()->back();;
    }

    public function rawMaterialStatus(Request $request)
    {
        $model = Rawmaterial::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    public function indexInventory()
    {
        $rawmaterials = Rawmaterial::where('deleteId', '0')->get();
        if (request('date') != null) {
            if (request('product') == 'All')
                $inventories = Inventoryhistory::with(['rawmaterial', 'product'])->whereDate('created_at', request('date'))->get();
            else
                $inventories = Inventoryhistory::with(['rawmaterial', 'product'])->whereDate('created_at', request('date'))->where('item', request('product'))->get();
        } else {
            $inventories = Inventoryhistory::with(['rawmaterial', 'product'])->where('id', 0)->get();
        }
        // $inventories = Inventoryhistory::with(['rawmaterial','product'])->get();
        // return $inventories;
        return view('admin.inventoryHistory', compact('rawmaterials', 'inventories'));
    }

    public function updateInventory(Request $request)
    {
        $rawMaterial = Rawmaterial::where('UID', $request->hiddenId)->first();
        if ($request->action == 'Add') {
            $rawMaterial->stock += $request->qty;
        } else {
            $rawMaterial->stock -= $request->qty;
        }
        $rawMaterial->update();

        $inventory = new Inventoryhistory();
        $inventory->item = $rawMaterial->UID;
        $inventory->quantity = $request->qty;
        $inventory->action = $request->action;
        $inventory->date = $request->date;
        $inventory->save();

        Session()->flash('alert-success', "Raw Material Updated Succesfully");
        $this->storeLog('Update', 'updateRawMaterial', $rawMaterial);
        return redirect()->back();;
    }

    // Product Controller

    public function indexProduct(Request $request)
    {
        $categories = Category::where('deleteId', '0')->where('status', 1)->get();
        $subcategories = Subcategory::where('deleteId', '0')->where('status', 1)->get();
        $mealTypes = Mealtype::where('deleteId', '0')->where('status', 1)->get();
        $products = [];
        if ($request->_token) {
            $productQuery = Product::query();
            $productQuery->when($request->category, function ($query, $category) {
                return $query->where('categoryId', $category);
            })->when($request->subCategory, function ($query, $subcategory) {
                return $query->where('subcategoryId', $subcategory);
            })->when($request->mealType, function ($query, $mealType) {
                return $query->where('mealTypeId', $mealType);
            })->when($request->alaCart, function ($query, $status) {
                return $query->where('alaCartFlag', $status);
            });

            $products = $productQuery->where('deleteId', '0')->with('category')->with('subcategory')->with('mealtype')->get();
        }
        return view('admin.product', compact('products', 'categories', 'subcategories', 'mealTypes'));
    }

    public function indexAddProduct()
    {
        $categories = Category::where('deleteId', '0')->where('status', 1)->get();
        $subcategories = Subcategory::where('deleteId', '0')->where('status', 1)->with('category')->get();
        // return $subcategories;
        $mealTypes = Mealtype::where('deleteId', '0')->where('status', 1)->get();
        $goals = Goal::where('deleteId', '0')->where('status', 1)->get();
        $rawMaterials = Rawmaterial::where('deleteId', '0')->where('status', 1)->get();
        $mealTimes = Mealtime::all();
        return view('admin.productAdd', compact('categories', 'subcategories', 'mealTypes', 'goals', 'rawMaterials', 'mealTimes'));
    }

    public function checkPUID(Request $request)
    {
        $puid = Product::where('UID', $request->uid)->first();
        if ($puid) {
            return response()->json([
                'status' => 200,
                'message' => 'PUID Already Exists',
            ]);
        }
    }

    public function storeProduct(Request $request)
    {
        $product = new Product;
        // store Image
        $uploadpath = 'media/images/product';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/product/' . $final_name, 0777);
            $image_path = "media/images/product/" . $final_name;
        } else {
            $image_path = null;
        }
        $product->image = $image_path;
        $product->UID = $request->UID;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discountedPrice = $request->discountedPrice;

        // convert array into string
        $meals = implode(',', $request->mealTime);

        $product->mealTime = $meals;
        $product->goalId = $request->goalId;
        $product->mealTypeId = $request->mealTypeId;
        $product->categoryId = $request->categoryId;
        $product->subCategoryId = $request->subcategoryId;
        $product->alaCartFlag = $request->alaCartFlag;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->save();

        $macros = new Productmacro();
        $macros->productUId = $request->UID;
        $macros->calories = $request->calories;
        $macros->carbs = $request->carbs;
        $macros->sugar = $request->sugar;
        $macros->fat = $request->fat;
        $macros->protien = $request->protein;
        $macros->zinc = $request->zinc;
        $macros->iron = $request->iron;
        $macros->mag = $request->mag;
        $macros->sodium = $request->sodium;
        $macros->copper = $request->copper;
        $macros->potasium = $request->potassium;
        $macros->save();

        for ($i = 1; $i <= $request->totalRecipe; $i++) {
            $rawField = 'rawMaterial' . $i;
            $qtyField = 'quantity' . $i;
            $unitField = 'unit' . $i;
            $recipe = new Productreceipe();
            $recipe->productUId = $request->UID;
            $recipe->rawMaterialUID = $request->$rawField;
            $recipe->quantity = $request->$qtyField;
            $recipe->unit = $request->$unitField;
            $recipe->save();
        }
        Session()->flash('alert-success', "Product Added Succesfully");
        $this->storeLog('Add', 'storeProduct', $product);
        return redirect('/product');
    }

    public function importProduct(Request $request)
    {
        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/Product/';
            $filepath = 'storage/ExcelFiles/Product/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/Product/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $repeated_lov = array();
            $counter = 0;
            $failed = 0;
            $repeated = 0;
            $total = count($rowData);
            foreach ($rowData as $key => $value) {
                if (empty($value)) {
                    $counter--;
                } else {
                    if ($value[0] == '' || $value[1] == '' || $value[2] == '' || $value[3] == '' || $value[4] == '' || $value[5] == '' || $value[6] == '' || $value[7] == '' || $value[8] == '' || $value[9] == '' || $value[10] == '') {
                        $failed++;
                        $skip_lov[] = $key + 2;
                        continue;
                    } else {
                        // meal time
                        $formatedMealTime = $value[4];
                        $formatedMealTime = trim($formatedMealTime);
                        $formatedMealTime = strtolower($formatedMealTime);
                        $formatedMealTime = str_split($formatedMealTime);
                        $formatedMealTime = implode(',', $formatedMealTime);

                        // meal type
                        $mealTypeName = $value[5];
                        $mealTypeName = trim($mealTypeName);
                        // error_log($mealTypeName);
                        $mealType = Mealtype::where('name', $mealTypeName)->select('id')->first();

                        // goal
                        $goalName = $value[6];
                        $goalName = trim($goalName);
                        $goal = Goal::where('name', $goalName)->select('id')->first();

                        // category
                        $categoryName = $value[7];
                        $categoryName = trim($categoryName);
                        $category = Category::where('name', $categoryName)->select('id')->first();

                        // subcategory
                        $subcategoryName = $value[8];
                        $subcategoryName = trim($subcategoryName);
                        $subcategory = Subcategory::where('name', $subcategoryName)->select('id')->first();

                        // updateorcreate
                        Product::updateOrCreate(
                            [
                                'UID' => $value[0]
                            ],
                            [
                                'name' => $value[1],
                                'slug' => Str::slug($value[1]),
                                'price' => $value[2],
                                'discountedPrice' => $value[3],
                                'mealTime' => $formatedMealTime,
                                'goalId' => $goal->id,
                                'mealTypeId' => $mealType->id,
                                'categoryId' => $category->id,
                                'subCategoryId' => $subcategory->id,
                                'alaCartFlag' => $value[9] == 'Yes' ? 1 : 0,
                                'status' => $value[10] == 'Active' ? 1 : 0,
                                'description' => $value[11],
                            ]
                        );
                    }
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully ");
            Session()->flash('counter', $total - 1 . " Records Processed ");
            Session()->flash('success', $counter . " Records Succesfully Added ");
            Session()->flash('failed', $failed . " Records Failed ");
            Session()->flash('repeated', $repeated . " Records Repeated ");
            Session()->flash('failedIds', $skip_lov);
            Session()->flash('repeatedIds', $repeated_lov);
            // $this->storeLog('Add', 'importProduct', $fieldData);
            // delete excel file
            unlink($filepath);
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    public function importProductMacro(Request $request)
    {
        // return "hii";
        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/ProductMacro/';
            $filepath = 'storage/ExcelFiles/ProductMacro/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/ProductMacro/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $repeated_lov = array();
            $counter = 0;
            $failed = 0;
            $repeated = 0;
            $total = count($rowData);
            foreach ($rowData as $key => $value) {
                if (empty($value)) {
                    $counter--;
                } else {
                    if ($value[0] == '' || $value[1] == '' || $value[2] == '' || $value[3] == '') {
                        $failed++;
                        $skip_lov[] = $key + 2;
                        continue;
                    } else if (Productmacro::where('productUId', $value[0])->exists()) {
                        $repeated++;
                        $repeated_lov[] = $key + 2;
                        continue;
                    } else {
                        $fieldData = new Productmacro();  //name of modal
                        $fieldData->productUId = $value[0]; //name of database feild = colm no in xls
                        $fieldData->calories = $value[1] != '' ? $value[1] : 0;
                        $fieldData->carbs = $value[2] != '' ? $value[2] : 0;
                        $fieldData->sugar = $value[3] != '' ? $value[3] : 0;
                        $fieldData->fat = $value[4] != '' ? $value[4] : 0;
                        $fieldData->protien = $value[5] != '' ? $value[5] : 0;
                        $fieldData->zinc = $value[6]    != '' ? $value[6] : 0;
                        $fieldData->iron = $value[7]   != '' ? $value[7] : 0;
                        $fieldData->mag = $value[8]  != '' ? $value[8] : 0;
                        $fieldData->sodium = $value[9] != '' ? $value[9] : 0;
                        $fieldData->copper = $value[10]     != '' ? $value[10] : 0;
                        $fieldData->potasium = $value[11]  != '' ? $value[11] : 0;
                        $fieldData->save();
                    }
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully ");
            Session()->flash('counter', $total - 1 . " Records Processed ");
            Session()->flash('success', $counter . " Records Succesfully Added ");
            Session()->flash('failed', $failed . " Records Failed ");
            Session()->flash('repeated', $repeated . " Records Repeated ");
            Session()->flash('failedIds', $skip_lov);
            Session()->flash('repeatedIds', $repeated_lov);
            $this->storeLog('Add', 'importProductMacro', $fieldData);
            // delete excel file
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    public function importProductRecipe(Request $request)
    {
        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/ProductRecipe/';
            $filepath = 'storage/ExcelFiles/ProductRecipe/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/ProductRecipe/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $repeated_lov = array();
            $counter = 0;
            $failed = 0;
            $repeated = 0;
            $total = count($rowData);

            foreach ($rowData as $key => $value) {
                if (empty($value)) {
                    $counter--;
                } else {
                    if ($value[0] == '' || $value[1] == '' || $value[2] == '' || $value[3] == '') {
                        $failed++;
                        $skip_lov[] = $key + 2;
                        continue;
                    } else if (Productreceipe::where('productUId', $value[0])->exists()) {
                        $repeated++;
                        $repeated_lov[] = $key + 2;
                        continue;
                    } else {
                        $totalColumn = count($value) - 1;
                        $i = 1;
                        while ($i <= $totalColumn) {
                            if ($value[$i] == null)
                                break;
                            $fieldData = new Productreceipe();
                            $fieldData->productUId = $value[0];
                            $fieldData->rawMaterialUID = $value[$i];
                            $i = $i + 1;
                            $fieldData->quantity = $value[$i];
                            $i = $i + 1;
                            $fieldData->unit = $value[$i];
                            $i = $i + 1;
                            $fieldData->save();
                        }
                    }
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully ");
            Session()->flash('counter', $total - 1 . " Records Processed ");
            Session()->flash('success', $counter . " Records Succesfully Added ");
            Session()->flash('failed', $failed . " Records Failed ");
            Session()->flash('repeated', $repeated . " Records Repeated ");
            Session()->flash('failedIds', $skip_lov);
            Session()->flash('repeatedIds', $repeated_lov);
            $this->storeLog('Add', 'importProductRecipe', $fieldData);
            // delete excel file
            unlink($filepath);
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    public function indexUpdateProduct($slug)
    {
        $data = Product::where('slug', $slug)->with('macro')->with(['recipe' => function ($query) {
            $query->with('rawmaterial');
        }])->first();
        // return $data;
        $categories = Category::where('deleteId', '0')->where('status', 1)->get();
        $subcategories = Subcategory::where('deleteId', '0')->where('status', 1)->get();
        $mealTypes = Mealtype::where('deleteId', '0')->where('status', 1)->get();
        $goals = Goal::where('deleteId', '0')->where('status', 1)->get();
        $rawMaterials = Rawmaterial::where('deleteId', '0')->where('status', 1)->get();
        $mealTimes = Mealtime::all();
        return view('admin.productUpdate', compact('data', 'categories', 'subcategories', 'mealTypes', 'goals', 'rawMaterials', 'mealTimes'));
    }

    public function addRecipe(Request $request)
    {
        $data = new Productreceipe;
        $data->productUId = $request->productUID;
        $data->rawMaterialUId = $request->rawMaterialUId;
        $data->quantity = $request->quantity;
        $data->unit = $request->unit;
        $data->save();

        return response()->json([
            'status' => 'successfully added',
        ]);
    }
    public function updateRecipe($id, Request $request)
    {
        $data = Productreceipe::find($id);
        $data->rawMaterialUId = $request->rawMaterialUId;
        $data->quantity = $request->quantity;
        $data->unit = $request->unit;
        $data->update();

        return response()->json([
            'status' => 'successfully updated',
        ]);
    }

    public function deleteRecipe($id)
    {
        $data = Productreceipe::find($id);
        $data->delete();

        return response()->json([
            'status' => 'successfully deleted',
        ]);
    }

    public function exportProductExcel($Product_data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($Product_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Product_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function exportProductData()
    {
        $this->storeLog('Export', 'exportProductData', '-');
        $data = Product::all();

        $data_array[] = array("Product UID", "Name", "Price", "Discounted Price", "Meal Time", "Meal Type", "Goal", "Category", "Sub Category", "Display in alacart", "Description", "Status", "Deleted", "Created At", "Updated At");
        foreach ($data as $data_item) {

            $productData = Product::where('UID', $data_item->UID)->first();

            $mealTime = $productData->mealTime;
            $mealTime = str_replace(',', '', $mealTime);
            $mealTime = strtoupper($mealTime);
            $mealType = Mealtype::find($productData->mealTypeId);
            $goal = Goal::find($productData->goalId);
            $category = Category::find($productData->categoryId);
            $subcategory = Subcategory::find($productData->subCategoryId);

            $data_array[] = array(
                'Product UID' => $data_item->UID,
                'Name' => $data_item->name,
                'Price' => $data_item->price,
                'Discounted Price' => $data_item->discountedPrice,
                'Meal Time' => $mealTime,
                'Meal Type' => $mealType->name,
                'Goal' => $goal->name,
                'Category' => $category->name,
                'Sub Category' => $subcategory->name,
                'Display in alacart' => $data_item->alaCartFlag == 1 ? 'Yes' : 'No',
                'Description' => $data_item->description,
                'Status' => $data_item->status == 1 ? 'Active' : 'Inactive',
                'deleteId' => $data_item->deleteId == 1 ? 'Deleted' : 'Not Deleted',
                'Created At' => $data_item->created_at,
                'Updated At' => $data_item->updated_at,
            );
        }
        $this->exportProductExcel($data_array);
    }

    public function updateProduct(Request $request)
    {
        $product = Product::where('UID', $request->hiddenId)->first();
        // store Image
        $uploadpath = 'media/images/product';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/product/' . $final_name, 0777);
            $image_path = "media/images/product/" . $final_name;
        } else {
            $image_path = Product::where('uid', $request->hiddenId)->first();
            $image_path = $image_path['image'];
        }
        $product->image = $image_path;
        $product->UID = $request->hiddenId;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discountedPrice = $request->discountedPrice;

        // convert array into string
        $meals = implode(',', $request->mealTime);

        $product->mealTime = $meals;
        $product->goalId = $request->goalId;
        $product->mealTypeId = $request->mealTypeId;
        $product->categoryId = $request->categoryId;
        $product->subCategoryId = $request->subcategoryId;
        $product->alaCartFlag = $request->alaCartFlag;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->save();

        $macros = new Productmacro();
        $macros->productUId = $request->UID;
        $macros->calories = $request->calories;
        $macros->carbs = $request->carbs;
        $macros->sugar = $request->sugar;
        $macros->fat = $request->fat;
        $macros->protien = $request->protein;
        $macros->zinc = $request->zinc;
        $macros->iron = $request->iron;
        $macros->mag = $request->mag;
        $macros->sodium = $request->sodium;
        $macros->copper = $request->copper;
        $macros->potasium = $request->potassium;
        $macros->save();
        Session()->flash('alert-success', "Product Updated Succesfully");
        $this->storeLog('Update', 'updateProduct', $product);
        return redirect('/product');
    }

    public function deleteProduct(Request $request)
    {
        $model = Product::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Product Updated Succesfully");
        $this->storeLog('Delete', 'deleteProduct', $model);
        return redirect()->back();;
    }

    public function productStatus(Request $request)
    {
        $model = Product::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // addon controller

    public function indexAddon()
    {
        $addons = Addon::where('deleteId', '0')->with('mealtype')->get();
        $mealTypes = Mealtype::where('deleteId', '0')->where('status', 1)->get();
        return view('admin.addon', compact('addons', 'mealTypes'));
    }

    public function checkUID(Request $request)
    {
        $addon = Addon::where('UID', $request->uid)->first();
        if ($addon->UID != $request->uid) {
            if ($addon) {
                return response()->json([
                    'status' => 200,
                    'message' => 'UID Already Exist',
                ]);
            }
        } else {
            return response()->json([
                'status' => 201,
                'message' => 'Existing UID',
            ]);
        }
    }

    public function storeAddon(Request $request)
    {
        $addon = new Addon;
        // store Image
        $uploadpath = 'media/images/addon';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/addon/' . $final_name, 0777);
            $image_path = "media/images/addon/" . $final_name;
        } else {
            $image_path = null;
        }
        $addon->image = $image_path;
        $addon->UID = $request->UID;
        $addon->name = $request->name;
        $addon->description = $request->description;
        $addon->price = $request->price;
        $addon->quantity = $request->quantity;
        $addon->unit = $request->unit;
        $addon->alaCartFlag = $request->alaCartFlag;
        $addon->mealTypeId = $request->mealType;
        $addon->status = $request->status;
        $addon->save();
        Session()->flash('alert-success', "Addon Added Succesfully");
        $this->storeLog('Add', 'storeAddon', $addon);

        return redirect()->back();;
    }

    public function updateAddon(Request $request)
    {
        $addon = Addon::find($request->hiddenId);
        // store Image
        $uploadpath = 'media/images/addon';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/addon/' . $final_name, 0777);
            $image_path = "media/images/addon/" . $final_name;
        } else {
            $image_path = Addon::where('id', $request->hiddenId)->first();
            $image_path = $image_path['image'];
        }
        $addon->image = $image_path;
        $addon->UID = $request->UID;
        $addon->name = $request->name;
        $addon->description = $request->description;
        $addon->price = $request->price;
        $addon->quantity = $request->quantity;
        $addon->unit = $request->unit;
        $addon->alaCartFlag = $request->alaCartFlag;
        $addon->mealTypeId = $request->mealType;
        if ($request->status != $addon->status) {
            $addon->status = $request->status;
        }
        $addon->update();
        Session()->flash('alert-success', "Addon Updated Succesfully");
        $this->storeLog('Update', 'updateAddon', $addon);
        return redirect()->back();
    }

    public function deleteAddon(Request $request)
    {
        $model = Addon::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Addon Updated Succesfully");
        $this->storeLog('Delete', 'deleteAddon', $model);
        return redirect()->back();;
    }

    public function addonStatus(Request $request)
    {
        $model = Addon::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    public function importAddon(Request $request)
    {
        $mealTypes = Mealtype::where('deleteId', '0')->where('status', 1)->select('id', 'name')->get();

        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/Product/';
            $filepath = 'storage/ExcelFiles/Product/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/Product/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $counter = 0;
            $failed = 0;
            foreach ($rowData as $value) {

                if (empty($value)) {
                    $counter--;
                } else {
                    $fieldData = new Addon();  //name of modal
                    $fieldData->name = $value[0]; //name of database feild = colm no in xls
                    $fieldData->description = $value[1];
                    $fieldData->price = $value[2];
                    $fieldData->quantity = $value[3];
                    $fieldData->unit = $value[4];
                    if ($value[5] == 'Yes') {
                        $fieldData->alaCartFlag = 1;
                    } else {
                        $fieldData->alaCartFlag = 0;
                    }
                    foreach ($mealTypes as $mealType) {
                        if ($mealType->name == $value[6]) {
                            $fieldData->mealTypeId = $mealType->id;
                        }
                    }
                    if ($value[7] == 'Active') {
                        $fieldData->status = 1;
                    } else {
                        $fieldData->status = 0;
                    }
                    $fieldData->save();
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully");
            $this->storeLog('Add', 'importAddon', $fieldData);
            // delete excel file
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    // package controller

    public function indexPackage()
    {
        // $bf = trim('   VEG SMOKED PANEER SANDWICH        ');
        // $bf = Product::where('name', $bf)->select('uid')->first();
        // return $bf->uid;
        $packages = Package::where('deleteId', '0')->with('goal')->with('mealtype')->get();
        return view('admin.package', compact('packages'));
    }

    public function indexAddPackage()
    {
        $goals = Goal::where('deleteId', '0')->where('status', 1)->get();
        $mealTypes = Mealtype::where('deleteId', '0')->where('status', 1)->get();
        return view('admin.packageAdd', compact('goals', 'mealTypes'));
    }

    public function checkPackUID(Request $request)
    {
        $package = Package::where('UID', $request->uid)->first();
        if ($package) {
            return response()->json([
                'status' => 200,
                'message' => 'UID Already Exist',
            ]);
        }
    }

    public function storePackage(Request $request)
    {
        $package = new Package;
        // store Image
        $uploadpath = 'media/images/package';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/package/' . $final_name, 0777);
            $image_path = "media/images/package/" . $final_name;
        } else {
            $image_path = null;
        }
        $package->image = $image_path;
        $package->UID = $request->UID;
        $package->name = $request->name;
        $package->description = $request->description;
        $package->goalId = $request->goalId;
        $package->mealTypeId = $request->mealTypeId;
        $package->bfPrice = $request->bfPrice;
        $package->lPrice = $request->lPrice;
        $package->sPrice = $request->sPrice;
        $package->dPrice = $request->dPrice;
        $package->status = $request->status;
        $package->save();

        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/PackageMenu/';
            $filepath = 'storage/ExcelFiles/PackageMenu/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/PackageMenu/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $counter = 0;
            $failed = 0;
            foreach ($rowData as $value) {

                if (empty($value)) {
                    $counter--;
                } else {
                    error_log($request->packageUId);
                    $pack = new Packagemenu;
                    $pack->packageUId = $request->UID;
                    $pack->day = $value[0];
                    $pack->breakFast = $value[1];
                    $pack->lunch = $value[2];
                    $pack->snack = $value[3];
                    $pack->dinner = $value[4];
                    $pack->save();
                }
                $counter++;
            }

            unlink($filepath);
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect('/package');
        }

        Session()->flash('alert-success', "Package Added Succesfully");
        $this->storeLog('Add', 'storePackage', $package);

        return redirect('/package');
    }

    public function indexUpdatePackage($uid)
    {
        $data = Package::where('UID', $uid)->first();
        $goals = Goal::where('deleteId', '0')->where('status', 1)->get();
        $mealTypes = Mealtype::where('deleteId', '0')->where('status', 1)->get();
        return view('admin.packageUpdate', compact('data', 'goals', 'mealTypes'));
    }

    public function updatePackage(Request $request)
    {
        $package = Package::find($request->hiddenId);
        // store Image
        $uploadpath = 'media/images/package';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/package/' . $final_name, 0777);
            $image_path = "media/images/package/" . $final_name;
        } else {
            $image_path = Package::where('id', $request->hiddenId)->first();
            $image_path = $image_path['image'];
        }
        $package->image = $image_path;
        $package->UID = $request->UID;
        $package->name = $request->name;
        $package->description = $request->description;
        $package->goalId = $request->goalId;
        $package->mealTypeId = $request->mealTypeId;
        $package->bfPrice = $request->bfPrice;
        $package->lPrice = $request->lPrice;
        $package->sPrice = $request->sPrice;
        $package->dPrice = $request->dPrice;
        if ($request->status != $package->status) {
            $package->status = $request->status;
        }
        $package->update();
        Session()->flash('alert-success', "Package Updated Succesfully");
        $this->storeLog('Update', 'updatePackage', $package);
        return redirect('/package');
    }

    public function indexPackageMenu($uid)
    {
        $packageData = Package::where('UID', $uid)->first();
        $data = Packagemenu::where('packageUId', $uid)->with('package')->with('bf')->with('l')->with('s')->with('d')->get();
        // return $data;
        return view('admin.packageMenu', compact('data', 'packageData'));
    }

    public function addPackageMenuExcel(Request $request)
    {
        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/PackageMenu/';
            $filepath = 'storage/ExcelFiles/PackageMenu/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/PackageMenu/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $repeated_lov = array();
            $counter = 0;
            $failed = 0;
            $repeated = 0;
            $total = count($rowData);
            foreach ($rowData as $key => $value) {

                if (empty($value)) {
                    $counter--;
                } else {
                    if ($value[0] == '' || $value[1] == '' || $value[2] == '' || $value[3] == '' || $value[4] == '' || $value[5] == '') {
                        $failed++;
                        $skip_lov[] = $key + 2;
                        continue;
                    } else {
                        // validate breakfast name
                        $bf = Product::where('name', $value[2])->select('uid')->first();
                        $lh = Product::where('name', $value[3])->select('uid')->first();
                        $sk = Product::where('name', $value[4])->select('uid')->first();
                        $dn = Product::where('name', $value[5])->select('uid')->first();

                        $productMenu = Packagemenu::updateOrCreate(
                            ['packageUId' => $request->packageUId, 'day' => $value[1]],
                            ['packageUId' => $value[0], 'day' => $value[1], 'breakFast' => $bf->uid, 'lunch' => $lh->uid, 'snack' => $sk, 'dinner' => $dn]
                        );
                    }
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully ");
            Session()->flash('counter', $total - 1 . " Records Processed ");
            Session()->flash('success', $counter . " Records Succesfully Added ");
            Session()->flash('failed', $failed . " Records Failed ");
            Session()->flash('repeated', $repeated . " Records Repeated ");
            Session()->flash('failedIds', $skip_lov);
            Session()->flash('repeatedIds', $repeated_lov);
            $this->storeLog('Add', 'importProductMenu', $productMenu);
            // delete excel file
            unlink($filepath);
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    public function exportPackageMenuExcel($packageMenu_data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($packageMenu_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="PackageMenu_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function exportPackageMenuData($uid)
    {
        // return "lol";
        $this->storeLog('Export', 'exportOfficeUserData', '-');
        $data = Packagemenu::where('packageUId', $uid)->orderBy('id', 'DESC')->get();
        $data_array[] = array("Id", "Package Id", "Day", "BreakFast", "Lunch", "Snack", "Dinner", "Created At", "Updated At");
        foreach ($data as $data_item) {

            $data_array[] = array(
                'Id' => $data_item->id,
                'Package Id' => $data_item->packageUId,
                'Day' => $data_item->day,
                'BreakFast' => $data_item->breakFast,
                'Lunch' => $data_item->lunch,
                'Snack' => $data_item->snack,
                'Dinner' => $data_item->dinner,
                'Created At' => $data_item->created_at,
                'Updated At' => $data_item->updated_at,
            );
        }
        $this->ExportOfficeUserExcel($data_array);
    }

    public function importMultiplePackageMenu(Request $request)
    {
        // $bf = trim('   VEG SALAD AND JUICE(ANY)');
        // $bf = Product::where('name', $bf)->select('uid')->first();
        // return $bf->uid;


        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/PackageMenu/';
            $filepath = 'storage/ExcelFiles/PackageMenu/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/PackageMenu/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $counter = 0;
            $failed = 0;
            foreach ($rowData as $value) {

                if (empty($value)) {
                    $counter--;
                } else {
                    // trim values
                    $value[2] = trim($value[2]);
                    $value[3] = trim($value[3]);
                    $value[4] = trim($value[4]);
                    $value[5] = trim($value[5]);

                    $bf = Product::where('name', $value[2])->select('uid')->first();
                    $lh = Product::where('name', $value[3])->select('uid')->first();
                    $sk = Product::where('name', $value[4])->select('uid')->first();
                    $dn = Product::where('name', $value[5])->select('uid')->first();

                    $packageMenu = Packagemenu::updateOrCreate(
                        [
                            'packageUId' => $value[0],
                            'day' => $value[1]
                        ],
                        [
                            'packageUId' => $value[0],
                            'day' => $value[1],
                            'breakFast' => $bf['uid'],
                            'lunch' => $lh['uid'],
                            'snack' => $sk['uid'],
                            'dinner' => $dn['uid']
                        ]
                    );
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully");
            $this->storeLog('Add', 'importPackageMenu', $packageMenu);
            // delete excel file
            unlink($filepath);
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    public function importPackage(Request $request)
    {
        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/Package/';
            $filepath = 'storage/ExcelFiles/Package/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/Package/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $counter = 0;
            $failed = 0;
            foreach ($rowData as $value) {

                if (empty($value)) {
                    $counter--;
                } else {
                    // goal
                    $goalName = $value[2];
                    $goalName = trim($goalName);
                    $goal = Goal::where('name', $goalName)->select('id')->first();
                    error_log($goal->id);

                    // meal type
                    $mealTypeName = $value[3];
                    $mealTypeName = trim($mealTypeName);
                    $mealType = Mealtype::where('name', $mealTypeName)->select('id')->first();
                    error_log($mealType->id);


                    $package = Package::insert(
                        [
                            'UID' => $value[0],
                            'name' => $value[1],
                            'goalId' => $goal->id,
                            'mealTypeId' => $mealType->id,
                            'bfPrice' => $value[4],
                            'lPrice' => $value[5],
                            'sPrice' => $value[6],
                            'dPrice' => $value[7],
                            'description' => $value[8],
                            'status' => $value[9] == 'Active' ? 1 : 0,
                        ]
                    );
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully");
            $this->storeLog('Add', 'importPackage', $package);
            // delete excel file
            unlink($filepath);
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    public function exportPackage()
    {
        $data = Package::all();
        $data_array[] = array('UID', 'Name', 'Goal', 'Meal Type', 'Breakfast Price', 'Lunch Price', 'Snack Price', 'Dinner Price', 'Description', 'Status', 'Created At', 'Updated At');
        foreach ($data as $data_item) {

            $goal = Goal::where('id', $data_item->goalId)->first();
            // return $goal->name;
            $mealType = Mealtype::where('id', $data_item->mealTypeId)->select('name')->first();

            $data_array[] = array(
                'UID' => $data_item->UID,
                'Name' => $data_item->name,
                'Goal' => $goal->name,
                'Meal Type' => $mealType->name,
                'Breakfast Price' => $data_item->bfPrice,
                'Lunch Price' => $data_item->lPrice,
                'Snack Price' => $data_item->sPrice,
                'Dinner Price' => $data_item->dPrice,
                'Description' => $data_item->description,
                'Status' => $data_item->status == 1 ? 'Active' : 'Inactive',
                'Created At' => $data_item->created_at,
                'Updated At' => $data_item->updated_at,
            );
        }

        $this->ExportPackageExcel($data_array);
    }

    public function exportPackageExcel($packageMenu_data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($packageMenu_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Package_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    public function deletePackage(Request $request)
    {
        $model = Package::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Package Updated Succesfully");
        $this->storeLog('Delete', 'deletePackage', $model);
        return redirect()->back();
    }

    public function packageStatus(Request $request)
    {
        $model = Package::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // pincode controller
    public function indexPincode()
    {
        $pincodes = Pincode::where('deleteId', '0')->orderBy('id', 'Desc')->get();
        return view('admin.pincode', compact('pincodes'));
    }

    public function storePincode(Request $request)
    {
        $pincode = new Pincode;
        $pincode->areaName = $request->name;
        $pincode->pincode = $request->pincode;
        $pincode->breakFastFlag = $request->breakFast;
        $pincode->lunchFlag = $request->lunch;
        $pincode->snackFlag = $request->snack;
        $pincode->dinnerFlag = $request->dinner;
        $pincode->alaCartFlag = $request->alaCart;
        $pincode->deliveryCharge = $request->deliveryCharge;
        $pincode->status = $request->status;
        $pincode->save();
        Session()->flash('alert-success', "Pincode Added Succesfully");
        $this->storeLog('Add', 'storePincode', $pincode);
        return redirect()->back();
    }

    public function updatePincode(Request $request)
    {
        $pincode = Pincode::find($request->hiddenId);
        $pincode->areaName = $request->name;
        $pincode->pincode = $request->pincode;
        $pincode->breakFastFlag = $request->breakFast;
        $pincode->lunchFlag = $request->lunch;
        $pincode->snackFlag = $request->snack;
        $pincode->dinnerFlag = $request->dinner;
        $pincode->alaCartFlag = $request->alaCart;
        $pincode->deliveryCharge = $request->deliveryCharge;
        $pincode->status = $request->status;
        $pincode->update();
        Session()->flash('alert-success', "Pincode Updated Succesfully");
        $this->storeLog('Update', 'updatePincode', $pincode);
        return redirect()->back();
    }

    public function deletePincode(Request $request)
    {
        $model = Pincode::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Pincode Updated Succesfully");
        $this->storeLog('Delete', 'deletePincode', $model);
        return redirect()->back();
    }

    public function pincodeStatus(Request $request)
    {
        $model = Pincode::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    public function importPincode(Request $request)
    {
        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        try {
            $file = $request->file('excel');
            $filename = time() . $file->getClientOriginalName();
            $uploadpath = 'storage/ExcelFiles/Product/';
            $filepath = 'storage/ExcelFiles/Product/' . $filename;
            $file->move($uploadpath, $filename);

            chmod('storage/ExcelFiles/Product/' . $filename, 0777);
            $xls_file = $filepath;
            $reader = new Xlsx();
            $spreadsheet = $reader->load($xls_file);
            $loadedSheetName = $spreadsheet->getSheetNames();

            $writer = new Csv($spreadsheet);
            $sheetName = $loadedSheetName[0];
            foreach ($loadedSheetName as $sheetIndex => $loadedSheetName) {
                $writer->setSheetIndex($sheetIndex);
                $writer->save($loadedSheetName . '.csv');
            }
            $inf = $sheetName . '.csv';
            $fileD = fopen($inf, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            $skip_lov = array();
            $counter = 0;
            $failed = 0;
            foreach ($rowData as $value) {

                if (empty($value)) {
                    $counter--;
                } else {
                    $fieldData = new Pincode();  //name of modal
                    $fieldData->areaName = $value[0]; //name of database feild = colm no in xls
                    $fieldData->pincode = $value[1];
                    if ($value[2] == 'Yes') {
                        $fieldData->breakFastFlag = 1;
                    } else {
                        $fieldData->breakFastFlag = 0;
                    }
                    if ($value[3] == 'Yes') {
                        $fieldData->lunchFlag = 1;
                    } else {
                        $fieldData->lunchFlag = 0;
                    }
                    if ($value[4] == 'Yes') {
                        $fieldData->snackFlag = 1;
                    } else {
                        $fieldData->snackFlag = 0;
                    }
                    if ($value[5] == 'Yes') {
                        $fieldData->dinnerFlag = 1;
                    } else {
                        $fieldData->dinnerFlag = 0;
                    }
                    if ($value[6] == 'Yes') {
                        $fieldData->alaCartFlag = 1;
                    } else {
                        $fieldData->alaCartFlag = 0;
                    }
                    $fieldData->deliveryCharge = $value[7];
                    $fieldData->status = 1;

                    $fieldData->save();
                }
                $counter++;
            }
            Session()->flash('alert-success', "File Uploaded Succesfully");
            $this->storeLog('Add', 'importPincode', $fieldData);
            // delete excel file
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            Session()->flash('alert-danger', 'error:' . $e);
            return redirect()->back();
        }
    }

    // booking controller

    public function indexBooking()
    {
        $bookings = consultation::all();
        $users = User::where('deleteId', '0')->whereIn('role', [2])->get();
        $dieticians = User::where('deleteId', '0')->whereIn('role', [3])->get();
        return view('admin.booking', compact('bookings', 'users', 'dieticians'));
    }

    public function addBooking(Request $request)
    {
        $model = new consultation;
        $model->userId = $request->userId;
        $model->dieticianId = $request->dietcianId;
        $model->consultDate = $request->consultDate;
        $model->consultTime = $request->consultTime;
        $model->paymentStatus = $request->paymentStatus;
        // $model->trxId = $request->trxId;
        $model->status = $request->status;
        $model->save();
        Session()->flash('alert-success', "Booking Added Succesfully");
        $this->storeLog('Add', 'addBooking', $model);

        return redirect()->back();
    }

    public function updateBooking(Request $request)
    {
        $model = consultation::find($request->hiddenId);
        if ($request->status != $model->status) {
            $model->status = $request->status;
        }
        $model->update();
        Session()->flash('alert-success', "Booking Updated Succesfully");
        $this->storeLog('Update', 'updateBooking', $model);
        return redirect()->back();
    }

    public function deleteBooking(Request $request)
    {
        $model = consultation::find($request->hiddenId)->delete();
        Session()->flash('alert-success', "Booking Updated Succesfully");
        $this->storeLog('Delete', 'deleteBooking', $model);
        return redirect()->back();
    }

    // review controller

    public function indexReview()
    {
        $reviews = Review::with('user')->with('product')->with('package')->get();
        return view('admin.review', compact('reviews'));
    }

    public function deleteReview(Request $request)
    {
        $model = Review::find($request->hiddenId);
        $model->delete();
        Session()->flash('alert-success', "Review Updated Succesfully");
        $this->storeLog('Delete', 'deleteReview', $model);
        return redirect()->back();
    }

    public function reviewStatus(Request $request)
    {
        $model = Review::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // bulk enquiry controller

    public function indexBulkEnquiry()
    {
        $enquiries = Enquirybulk::all();
        return view('admin.enquiryBulk', compact('enquiries'));
    }

    public function deleteBulkEnquiry(Request $request)
    {
        $model = Enquirybulk::find($request->hiddenId);
        $model->delete();
        Session()->flash('alert-success', "Enquiry Deleted Succesfully");
        $this->storeLog('Delete', 'deleteBulkEnquiry', $model);
        return redirect()->back();
    }

    // franchise enquiry controller

    public function indexFranchiseEnquiry()
    {
        $enquiries = Enquiryfranchise::all();
        return view('admin.enquiryFranchise', compact('enquiries'));
    }

    public function deleteFranchiseEnquiry(Request $request)
    {
        $model = Enquiryfranchise::find($request->hiddenId);
        $model->delete();
        Session()->flash('alert-success', "Enquiry Deleted Succesfully");
        $this->storeLog('Delete', 'deleteFranchiseEnquiry', $model);
        return redirect()->back();
    }

    // Blog Controller

    public function indexBlog()
    {
        $blogs = Blog::where('deleteId', '0')->get();
        return view('admin.blog', compact('blogs'));
    }

    public function createBlog()
    {
        // return Auth::User()->name;
        return view('admin.addBlog');
    }

    public function storeBlog(Request $request)
    {
        $blog = new Blog;
        $blog->title = $request->title;
        // slug
        $blog->slug = Str::slug($request->title, '-');
        $blog->subtitle = $request->subtitle;
        $blog->tags = $request->tags;

        $uploadpath = 'media/images/blog';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/blog/' . $final_name, 0777);
            $image_path = "media/images/blog/" . $final_name;
        } else {
            $image_path = null;
        }

        $blog->coverImage = $image_path;
        $blog->creator = Auth::User()->name;
        $blog->writer = $request->writer;
        $blog->status = $request->status;
        $blog->description1 = $request->desc1;
        $blog->description2 = $request->desc2;
        $blog->save();
        Session()->flash('alert-success', "Blog Added Succesfully");
        $this->storeLog('Add', 'storeBlog', $blog);
        return redirect('blog');
    }

    public function showBlogUpdate($slug)
    {
        $blog = blog::where('deleteId', '0')->where('slug', $slug)->first();
        return view('admin.blogUpdate', compact('blog'));
    }

    public function updateBlog(Request $request)
    {
        $blog = Blog::find($request->hiddenId);
        $blog->title = $request->title;
        // slug
        $blog->slug = Str::slug($request->title, '-');
        $blog->subtitle = $request->subtitle;
        $blog->tags = $request->tags;
        $uploadpath = 'media/images/blog';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/blog/' . $final_name, 0777);
            $image_path = "media/images/blog/" . $final_name;
        } else {
            $image_path = Blog::where('id', $request->hiddenId)->first();
            $image_path = $image_path['coverImage'];
        }

        $blog->coverImage = $image_path;
        $blog->creator = Auth::User()->name;
        $blog->writer = $request->writer;
        $blog->status = $request->status;
        $blog->description1 = $request->desc1;
        $blog->description2 = $request->desc2;
        $blog->update();
        Session()->flash('alert-success', "Blog Updated Succesfully");
        $this->storeLog('Update', 'updateBlog', $blog);
        return redirect('blog');
    }

    public function deleteBlog(Request $request)
    {
        $model = Blog::find($request->hiddenId);

        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Blog Deleted Succesfully");
        $this->storeLog('Delete', 'deleteBlog', $model);
        return redirect()->back();
    }

    public function blogStatus(Request $request)
    {
        $model = Blog::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // testimonial controller

    public function indexTestimonial()
    {
        $testimonials = Testimonial::where('deleteId', 0)->get();
        return view('admin.testimonial', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $uploadpath = 'media/images/testimonials';
        $testimonials = new Testimonial();

        $testimonials->type = $request->type;
        $testimonials->name = $request->name;
        $testimonials->comment = $request->description;

        if ($request->hasFile('media')) {
            $image = $request->file('media');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);

            chmod('media/images/testimonials/' . $final_name, 0777);
            $image_path = "media/images/testimonials/" . $final_name;
        } else {
            $image_path = null;
        }
        $testimonials->media = $image_path;
        $testimonials->status = $request->status;

        $testimonials->save();
        Session()->flash('alert-success', "Testimonial Added Succesfully");
        $this->storeLog('Add', 'storeTestimonial', $testimonials);

        return redirect()->back();
    }

    public function updateTestimonial(Request $request)
    {
        $uploadpath = 'media/images/testimonials';
        $testimonials = Testimonial::find($request->hiddenId);
        $testimonials->type = $request->types;
        $testimonials->name = $request->name;
        $testimonials->comment = $request->description;

        if ($request->hasFile('media')) {
            $image = $request->file('media');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/testimonials/' . $final_name, 0777);
            $image_path = "media/images/testimonials/" . $final_name;
        } else {
            $image_path = Testimonial::where('id', $request->hiddenId)->first();
            $image_path = $image_path['media'];
        }
        $testimonials->media = $image_path;
        $testimonials->status = $request->status;

        $testimonials->update();
        Session()->flash('alert-success', "Testimonial Updated Succesfully");
        $this->storeLog('Update', 'updateTestimonial', $testimonials);

        return redirect()->back();
    }

    public function deleteTestimonial(Request $request)
    {
        $model = Testimonial::find($request->hiddenId);
        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Testimonial Deleted Succesfully");
        $this->storeLog('Delete', 'deleteTestimonial', $model);
        return redirect()->back();
    }

    public function testimonialStatus(Request $request)
    {
        $model = Testimonial::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // Banner controller

    public function indexBanner()
    {
        $banners = Banner::orderBy('sequence', 'Asc')->get();
        return view('admin.banner', compact('banners'));
    }

    public function storeBanner(Request $request)
    {
        $uploadpath = 'media/images/banner';
        $banner = new Banner;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/banner/' . $final_name, 0777);
            $image_path = "media/images/banner/" . $final_name;
        } else {
            $image_path = null;
        }
        $banner->image = $image_path;
        $banner->sequence = $request->sequence;
        $banner->save();
        Session()->flash('alert-success', "Banner Added Succesfully");
        $this->storeLog('Add', 'storeBanner', $banner);
        return redirect()->back();
    }

    public function updateBanner(Request $request)
    {
        $uploadpath = 'media/images/banner';
        $banner = Banner::find($request->hiddenId);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/banner/' . $final_name, 0777);
            $image_path = "media/images/banner/" . $final_name;
        } else {
            $image_path = Banner::where('id', $request->hiddenId)->first();
            $image_path = $image_path['image'];
        }
        $banner->image = $image_path;
        $banner->sequence = $request->sequence;
        $banner->update();
        Session()->flash('alert-success', "Banner Updated Succesfully");
        $this->storeLog('Update', 'updateBanner', $banner);
        return redirect()->back();
    }

    public function deleteBanner(Request $request)
    {
        $model = Banner::find($request->hiddenId)->delete();
        Session()->flash('alert-success', "Banner Deleted Succesfully");
        $this->storeLog('Delete', 'deleteBanner', $model);
        return redirect()->back();
    }


    // coupons controller

    public function indexCoupon()
    {
        $coupons = Coupon::where('deleteId', 0)->get();
        return view('admin.coupon', compact('coupons'));
    }

    public function storeCoupon(Request $request)
    {
        $uploadpath = 'media/images/coupons';
        $coupons = new Coupon;
        $coupons->name = $request->name;
        $coupons->description = $request->description;
        $coupons->amount = $request->amount;
        $coupons->couponType = $request->type;
        $coupons->startDate = $request->startDate;
        $coupons->endDate = $request->endDate;
        $coupons->for = $request->for;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();

            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/coupons/' . $final_name, 0777);
            $image_path = "media/images/coupons/" . $final_name;
        } else {
            $image_path = null;
        }
        $coupons->image = $image_path;
        $coupons->status = $request->status;
        $coupons->save();
        Session()->flash('alert-success', "Coupon Added Succesfully");
        $this->storeLog('Add', 'storeCoupon', $coupons);
        return redirect()->back();
    }

    public function updateCoupon(Request $request)
    {
        $uploadpath = 'media/images/coupons';
        $coupons = Coupon::find($request->hiddenId);
        $coupons->name = $request->name;
        $coupons->description = $request->description;
        $coupons->amount = $request->amount;
        $coupons->couponType = $request->coupon;
        $coupons->startDate = $request->startDate;
        $coupons->endDate = $request->endDate;
        $coupons->usageType = $request->usage;
        $coupons->category = $request->category;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();

            $final_name = time() . $image_name;
            $image->move($uploadpath, $final_name);
            chmod('media/images/coupons/' . $final_name, 0777);
            $image_path = "media/images/coupons/" . $final_name;
        } else {
            $image_path = Coupon::where('id', $request->hiddenId)->first();
            $image_path = $image_path['image'];
        }
        $coupons->image = $image_path;
        $coupons->status = $request->status;
        $coupons->update();
        Session()->flash('alert-success', "Coupon Updated Succesfully");
        $this->storeLog('Update', 'updateCoupon', $coupons);
        return redirect()->back();
    }

    public function deleteCoupon(Request $request)
    {
        $model = Coupon::find($request->hiddenId);
        $model->deleteId = 1;
        $model->save();
        Session()->flash('alert-success', "Coupon Deleted Succesfully");
        $this->storeLog('Delete', 'deleteCoupon', $model);
        return redirect()->back();
    }

    public function couponStatus(Request $request)
    {
        $model = Coupon::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            'status' => 200,
            'message' => 'Status Changed Successfully',
        ]);
    }

    // faqs controller

    public function indexFaq()
    {
        $faqs = Faq::where('deleteId', 0)->get();
        return view('admin.faqs', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $faqs = new Faq;
        $faqs->question = $request->question;
        $faqs->answer = $request->answer;
        $faqs->sequence = $request->sequence;
        $faqs->status = $request->status;
        $faqs->save();

        Session()->flash('alert-success', "Faq Added Succesfully");
        $this->storeLog('Add', 'storeFaq', $faqs);
        return redirect()->back();
    }

    public function updateFaq(Request $request)
    {
        $faqs = Faq::find($request->hiddenId);
        $faqs->question = $request->question;
        $faqs->answer = $request->answer;
        $faqs->sequence = $request->sequence;
        $faqs->status = $request->status;
        $faqs->update();

        Session()->flash('alert-success', "Faq Updated Succesfully");
        $this->storeLog('Update', 'updateFaq', $faqs);
        return redirect()->back();
    }

    public function deleteFaq(Request $request)
    {
        $model = Faq::find($request->hiddenId)->delete();

        Session()->flash('alert-success', "Faq Deleted Succesfully");
        $this->storeLog('Delete', 'deleteFaq', $model);
        return redirect()->back();
    }

    // wallet controller

    public function indexWallet()
    {
        $wallets = Wallet::with('user')->get();
        // $this->createWalletUser(13);
        // return $wallets;
        return view('admin.wallet', compact('wallets'));
    }

    public function updateWallet(Request $request)
    {
        // $wallet = Wallet::find($request->hiddenId);
        if ($request->type == 'Debit') {
            $this->debitAmount($request->hiddenUserId, $request->amount, 0, null, null, 'Changed By Admin');
        } elseif ($request->type == 'Credit') {
            $this->creditAmount($request->hiddenUserId, $request->amount, 0, null, null, 'Changed By Admin');
        }

        Session()->flash('alert-success', "Wallet Updated Succesfully");
        $this->storeLog('Update', 'updateWallet', 'updated by admin');
        return redirect()->back();
    }

    public function walletHistory($id)
    {
        $wallets = Wallet::with('user')->with('walletremarks')->where('userId', $id)->first();
        // return $wallets;
        return view('admin.walletHistory', compact('wallets'));
    }


    // Orders Controller
    public function updateTrxStatus(Request $request)
    {
        $order = transction::find($request->hiddenId);
        $order->deliverystatus = $request->status;
        $order->update();

        if ($order->trxFor == 'Alacart') {
            $alacartOrders = alacartorder::where('trxId', $request->hiddenId)->get();
            $total = 0;
            foreach ($alacartOrders as $alacartOrder) {
                if ($alacartOrder->status != 'Cancelled') {
                    $alacartOrder->status = $request->status;

                    $total += ($alacartOrder->productPrice + $alacartOrder->addonprice) * $alacartOrder->qty;

                    $alacartOrder->update();
                }
            }

            $finalTotal = ($total + $order->deliveryamt + $order->gst) - $order->discount;
            $this->creditAmount($order->userId, $finalTotal, 0, $order->id, null, 'Order Cancelled');
        }


        Session()->flash('alert-success', "Order Status Updated Succesfully");
        $this->storeLog('Update', 'updateTrxStatus', $order);
        return redirect()->back();
    }

    // alacart orders

    public function indexAlacartOrder()
    {
        $alacartorders = transction::where('trxFor', 'alacart')->with('trxalacartorder')->with('user')->get();
        return view('admin.orders.alacart', compact('alacartorders'));
    }

    public function indexTodayAlacartOrder()
    {
        $alacartorders = transction::where('trxFor', 'alacart')->with('trxalacartorder')->with('user')->whereDate('created_at', Carbon::today())->get();
        return view('admin.orders.alacart', compact('alacartorders'));
    }

    public function updateAlacartOrder(Request $request)
    {
        $alacartorders = alacartorder::find($request->hiddenId);
        $alacartorders->status = $request->status;
        if ($request->status == 'Completed') {
            // $this->debitAmount($request->userId, $request->total, 0, $alacartorders->trxId , 'alacart' , 'Meal Completed');
            $this->manageInventory($alacartorders->productId, 'alacart');
        }
        $alacartorders->update();

        Session()->flash('alert-success', "Alacart Order Updated Succesfully");
        $this->storeLog('Update', 'updateAlacartOrder', $alacartorders);
        return redirect()->back();
    }

    public function cancelAlacartOrder(Request $request)
    {
        $alacartorders = alacartorder::find($request->id);
        $alacartorders->status = 'Cancelled';
        $alacartorders->update();
        $total = ($alacartorders->productPrice + $alacartorders->addonprice) * $alacartorders->qty;
        $this->creditAmount($request->userId, $total, 0, $alacartorders->trxId, 'alacart', 'Meal Cancelled');
        return response()->json([
            'status' => 200,
            'message' => 'Order Cancelled Successfully',
        ]);
    }

    public function indexFailedAlacartOrder()
    {
        $alacartorders = failtransction::where('trxFor', 'alacart')->with('trxalacartorder')->with('user')->get();
        return view('admin.orders.alacartFailed', compact('alacartorders'));
    }

    // package orders
    public function indexPackageOrder()
    {
        $packageorders = transction::where('trxFor', 'subscription')->with('trxsubscriptionorder')->with('user')->get();
        // return $packageorders;
        return view('admin.orders.package', compact('packageorders'));
    }

    public function indexTodayPackageOrder()
    {
        // $packageorders = transction::where('trxFor', 'subscription')->with('trxsubscriptionorder')->with('user')->whereDate('created_at', Carbon::today())->get();
        $packageorders = Subscriptionkt::with('trx')->with('user')->with('subscription')->whereDate('created_at', Carbon::today())->get();

        // return $packageorders;
        return view('admin.orders.package', compact('packageorders'));
    }

    public function updatePackageOrder(Request $request)
    {
        $packageorders = Subscriptionkt::find($request->hiddenId);
        // return $packageorders;
        $packageorders->status = $request->status;
        if ($request->status == 'Cancelled') {
            $this->creditAmount($packageorders->userId, 0, $packageorders->mealPrice, $packageorders->trxId, 'subscription', 'Package Order Cancelled');
        } else if ($request->status == 'Completed') {
            $this->debitAmount($packageorders->userId, 0, $packageorders->mealPrice, $packageorders->trxId, 'subscription', 'Package Order Delivered');
            $this->manageInventory($packageorders->productId, 'subscription');
        }

        $packageorders->update();

        Session()->flash('alert-success', "Package Order Updated Succesfully");
        $this->storeLog('Update', 'updatePackageOrder', $packageorders);
        return redirect()->back();
    }

    public function indexFailedPackageOrder()
    {
        $packageorders = failtransction::where('trxFor', 'subscription')->with('trxsubscriptionorder')->with('user')->get();
        return view('admin.orders.packageFailed', compact('packageorders'));
    }
}
