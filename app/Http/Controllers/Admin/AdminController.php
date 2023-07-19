<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;
use Session;
use DB;
use Intervention\Image\Facades\Image as Image;
//use Intervention\Image\Image as Image;
//use Intervention\Image\Facades\Image;
use Illuminate\Validation\Validator;
class AdminController extends Controller
{
    //
    public function dashboard()
    {
        Session::put('page','dashboard');
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data=$request->all();
            //echo "<pre>";print_r($data); die;
            $rules = [
               'email'=> 'required|email|max:255',
               'password'=>'required|max:30',
            ];

            $customeMsg =[

                'email.required'=>'Email is Required',
                'email.email'=>'Valid Email is Required',
                'password.required'=>'Password is Must Required'
            ];

            $this->validate($request,$rules,$customeMsg);

           if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']]))
           {
                return redirect('admin/dashboard');
           }
            else
            {
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }
        }

        return view('admin.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request)
    {
        Session::put('page','update-password');
        if($request->isMethod('post')){
            $data= $request->all();
              if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password))
             {
                if($data['new_pwd']==$data['confirm_pwd'])
                {
                    //  Auth::where('id',Auth::guard('admin')->user()->id)->update(['password'=>
                    //  bcrypt($data['new_pwd'])]);
                    // Auth::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt('new_pwt')]);
                     //return redirect()->back()->with('success_message','Password Updated Successfully!');
                  $id=Auth::guard('admin')->user()->id;
                  $ch= DB::table('admins')->where('id', $id)->update(array('password' => bcrypt($data['new_pwd'])));
                  return redirect()->back()->with('success_message','Password Updated Successfully!');
                  //   echo $ch;
                //   die;
                   //return redirect('admin/logout');
                    }else{
                      return redirect()->back()->with('error_message','New Password and Confirm Password are Not Match');
                }
            }
        else{
            return redirect()->back()->with('error_message','Your Current password id incorrect');
        }
    }
        return view('admin.update_password');
    }
    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        // print_r($data);
        // die;
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            return "true";
        }
        else {
           return "false";
        }

    }

    public function updateDetails(Request $request)
    {
        Session::put('page','update-details');
         if($request->isMethod('post'))
        {
            $data=$request->all();
            //echo "<pre>";print_r($data); die;
             $rules = [
               'admin_name'=> 'required|alpha',
               'admin_mobile'=>'required|numeric|min:10',
               'admin_image'=>'image',
            ];
             $customMsg =[
                'admin_name.required'=>'Name is Required',
                'admin_name.alpha'=>'Valid Name is Required',
                'admin_mobile.required'=>'Mobile Number is Must Required',
                'admin_mobile.min'=>'10 Digit Number required',
                'admin_image'=>'validate image required',
            ];
            $this->validate($request,$rules,$customMsg);
            if($request->hasFile('admin_image')){
                $image_tmp= $request->file('admin_image');
                if($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    //echo $extension;die;
                    $imageName= rand(111,9999).".".$extension;
                    $image_path= 'admin/image/photos/'.$imageName;
                    Image::make($image_tmp)->save($image_path);
                }
            }
                elseif(!empty($data['current_image']))
                {
                    $imageName=$data['current_image'];
                }
                else{
                    '';
            }
            $email=Auth::guard('admin')->user()->email;
            DB::table('admins')->where('email',$email)->update(array('name'=>$data['admin_name'],
            'mobile'=>$data['admin_mobile'],'image'=>$imageName));
            return redirect()->back()->with('success_message','Record is Successfully Updated!');
        }
        return view('admin.update_details');
}
}
