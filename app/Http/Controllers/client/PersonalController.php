<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice; 
use App\Models\Customer; 
use Illuminate\Support\Facades\Validator;
class PersonalController extends Controller
{
    //
    public function __construct()
    {
        $this->invoice = new Invoice();
        $this->customer = new Customer();
    }
    public function getPersonal(){
      
        $invoiceList = Invoice::getInvoiceByUserId();
        $detailCustomer = Customer::getDetailByCustomer();
        return view('home.personal',compact('invoiceList','detailCustomer'));
    }

    public function getDetailInvoice($id=0)
    {
       
        $detailList = Invoice::getDetailInvoice($id);
        return view('home.detailinvoicebypersonal',compact('detailList'));
    }
    public function updatePersonal(Request $request,$id)
    {
        
        $rules = [
            'name' => 'required',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'address'  => 'required', 
        ];
        
        $messages = [
            'name.required' => 'Tên bắt buộc phải nhập ',
            'phone.required' => 'Số điện thoại bắt buộc phải nhập ',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'address.required' => 'Địa chỉ bắt buộc phải nhập ',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{

                $dataUpdate = [
                    $request->name,
                    $request->phone,
                    $request->address,
                ];

                Customer::getUpdate($dataUpdate,$id);
                return redirect()->route('personal')->with('msg','Cập nhật thành công');
        }
    
    }

    
}
