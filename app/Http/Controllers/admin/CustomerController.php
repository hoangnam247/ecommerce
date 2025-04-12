<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    const _PER_PAGE = 6;
    public function __construct() {
        $this->customer = new Customer();
    }

    
    public function getCustomer(Request $request)
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
        $customerList = Customer::getCustomer($filters,$keywords,self::_PER_PAGE);
        return view('admin.customer',compact('customerList'));
    }

    public function getEditStatus($id=0,Request $request)
    {
        if(!empty($id)){
            $status = $request->status;
            Customer::editStatus($id,$status);
            return redirect()->route('customer')->with('msg','Cập nhật status customer thành công');
        }
        else{
            return redirect()->route('customer');
        }
    }
    public function getDelete($id=0)
    {
      
        if(!empty($id)){
            Customer::deleteCustomer($id);
            return redirect()->route('customer')->with('msg','Xóa customer thành công');
        }
        else{
            return redirect()->route('customer');
        }
            
    }
}
