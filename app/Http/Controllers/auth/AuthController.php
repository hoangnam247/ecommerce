<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Account;
use Mail;
use App\Mail\CheckPass;

class AuthController extends Controller
{
    private $customer;
    public function __construct() {
        $this->customer = new Customer();
        $this->account = new Account();
    }

   
    public function getLogin()
    {
        return view('home.login');
    }
    public function postLogin(Request $request)
    {
     
        $email = $request->email;
        $password =$request->password;
        $rules = [
            'email'  => 'required|email',
            'password' => 'required|min:6',
        ];
        $messages = [
            'email.required' => 'Email bắt buộc phải nhập ',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu  bắt buộc phải nhập',
            'password.min' => 'Mật khẩu bắt buộc lớn hơn :min kí tự',

        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();


        if($validator->fails()){
             
            $validator->errors()->add('msg','Da xay ra loi');
        }else {
            if(Auth::attempt(['email' => $email,'password'=>$password,'status'=> 1]))
            {
                return redirect()->route('home');
            }
            else{
                return redirect()->route('login')->with('msg','Đăng nhập không thành công hoặc tài khoản đã bị khóa');
            }
        }
        return back()->withErrors($validator);   
    }

    public function getForgot()
    {
        return view('home.forgot');
    }
    public function postForgot(Request $request)
    {
     
        $email = $request->email;
        $rules = [
            'email'  => 'required|email',
        ];
        $messages = [
            'email.required' => 'Email bắt buộc phải nhập ',
            'email.email' => 'Email không hợp lệ',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
            $validator->errors()->add('msg','Da xay ra loi');
        }else {
            
            if(!empty($email)){
                $check = Account::checkAccounts($email);
                if(empty($check[0]))
                {
                    return redirect()->route('forgot')->with('msg','Không tìm thấy tài khoản nào với email này.');
                }else{
                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $new_pass= substr(str_shuffle($permitted_chars), 0,6);
                    $mail = new CheckPass($new_pass);
                    Mail::to($email)->send($mail);
                    Account::updateAccounts($email,$new_pass);
                    return redirect()->route('login')->with('msg_login','Hãy đăng nhập');
                }

            }
        }
        return back()->withErrors($validator);   
    }

    public function getRegister()
    {
        return view('home.register');
    }
    public function postRegister(Request $request)
    {
        $rules = [
            'fullname' => 'required:min6', 
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed',
        ];

        $messages = [
            'fullname.required' => 'Họ tên bắt buộc phải nhập',
            'fullname.min' => 'Họ tên bắt buộc lớn hơn :min ký tự',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã trùng',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
            'password.integer' => 'Mật khẩu  không được nhỏ hơn :min ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng ',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();
        if($validator->fails()){
             
            $validator->errors()->add('msg','Da xay ra loi');

        }else{
            $dataInsert = [
                $request->fullname,
                $request->email,
                $request->password,

            ];

            $this->customer->addCustomer($dataInsert);
            return redirect()->route('login');
        }
    }


    public function getChangePass()
    {
        return view('home.changepass');
    }
    public function postChangePass(Request $request)
    {
     
        $oldpassword = $request->oldpassword;
        $password = $request->password;
        if(!empty($oldpassword)){
            $email = auth::user()->email;
            if(!(Auth::attempt(['email' => $email,'password'=>$oldpassword,'status'=> 1])))
            {
                return redirect()->route('changepass')->with('msg','Mật khẩu cũ sai');
            }
        }
        $rules = [
            'password' => 'required|string|min:6',
        ];
        $messages = [
            'password.required' => 'Mật khẩu  bắt buộc phải nhập',
			'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
            $validator->errors()->add('msg','Da xay ra loi');
        }else {
            
            Account::ChangePass($password,$email);
            return redirect()->route('personal')->with('msg_pass','Thay đổi mật khẩu thành công');
        }
        return back()->withErrors($validator);   
    }
    public function getLogout() {
		Auth::logout();
		return redirect()->route('home');
	}
    

}
