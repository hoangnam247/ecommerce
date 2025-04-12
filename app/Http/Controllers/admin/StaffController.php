<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    //
   
    const _PER_PAGE = 6; // số dòng trong 1 trang 
    public function __construct() {
        $this->staff = new Staff();
    }

    
    public function getStaff(Request $request)
    {
    
        
        $keywords = null;
        $filters = [];
        if(!empty($request->status))
        {
            $status = $request->status;
            if($status=='active'){
                $status = 1;
            }else{
                $status = 0;
            }
            $filters[]=['users.status','=',$status];
        }

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }

        $staffList = Staff::getStaff($filters,$keywords,self::_PER_PAGE);
        return view('admin.staff',compact('staffList'));
    }
    public function getAdd()
    {
        return view('admin.staff.add');
    }
    public function postAdd(Request $request)
    {
    
       
        $rules = [
            'name' => 'required|string|min:3',
            'phone' => 'required|string|min:10|max:15',
            'address' => 'required|string|min:5',
            'gender' => 'required|in:Nam,Nữ',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        
        // Xác định thông báo lỗi
        $messages = [
            'name.required' => 'Vui lòng nhập tên nhân viên.',
            'name.string' => 'Tên nhân viên phải là chuỗi.',
            'name.min' => 'Tên nhân viên phải có ít nhất :min ký tự.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.string' => 'Số điện thoại phải là chuỗi.',
            'phone.min' => 'Số điện thoại phải có ít nhất :min ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá :max ký tự.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.string' => 'Địa chỉ phải là chuỗi.',
            'address.min' => 'Địa chỉ phải có ít nhất :min ký tự.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'gender.in' => 'Giới tính phải là Nam hoặc Nữ.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã được sử dụng. Vui lòng chọn địa chỉ email khác.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
 
                $dataInsert = [
                    $request->name,
                    $request->phone,
                    $request->address,
                    $request->gender,
                    $request->email,
                    $request->password,
                ];

                Staff::addStaff($dataInsert);
                return redirect()->route('staff');
        }
        return back()->withErrors($validator); 
    }
    public function getEdit($id)
    {

        if(!empty($id)){
            $staffDetail = Staff::getDetail($id);
        }else{
            return redirect()->route('staff')->with('msg','Liên kết không tồn tại');
        } 
        return view('admin.staff.edit',compact('staffDetail'));

    }
    public  function postEdit(Request $request,$id=0)
    {
        
        $rules = [
            'name' => 'required|min:3',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required|in:Nam,Nữ',

        ];
        
        $messages = [
            'name.required' => 'Tên nhân viên là trường bắt buộc.',
            'name.min' => 'Tên nhân viên phải có ít nhất :min ký tự.',
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'gender.required' => 'Giới tính là trường bắt buộc.',
            'gender.in' => 'Giới tính không hợp lệ.',
        
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->validate();
        
        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
          
            $dataUpdate = [
                $request->name,
                $request->phone,
                $request->address,
                $request->gender,
                $request->status,
                $request->level,
            ];

                Staff::updateStaff($dataUpdate, $id);
                return redirect()->route('staff')->with('msg','Cập nhật staff thành công');
        }
     
    }
    public function getDelete($id=0)
    {
      
        if(!empty($id)){
            Staff::deleteStaff($id);
            return redirect()->route('staff')->with('msg','Xóa staff thành công');
        }
        else{
            return redirect()->route('staff');
        }
            
    }
}
