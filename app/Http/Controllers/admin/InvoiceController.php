<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Mail;
use App\Mail\SendInvoice;
class InvoiceController extends Controller
{
    //
    const _PER_PAGE = 6;
    public function __construct() {
        $this->invoice = new  Invoice();
    }

    
    public function getInvoice(Request $request)
    {
        $filters = [];
        $keywords = null;

        if(!empty($request->status))
        {
            $status = $request->status;
            if($status=='active'){
                $status = 1;
            }else if($status == 'inactive'){
                $status = 2;
            }else if($status == 'confirm'){
                $status = 3;
            }else if($status == 'cancel'){ 
                $status = 4;
            }else if($status == 'receive'){ 
                $status = 5;
            }else {
                $status = 0;
            }
            $filters[]=['invoice.status','=',$status];
        }

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $invoiceList = Invoice::getInvoice($filters,$keywords, self::_PER_PAGE);
        return view('admin.invoice',compact('invoiceList'));
    }
    public function getDetailInvoice($id=0)
    {
        $invoiceDetail = Invoice::getDetailByInvoice($id);
        $invoiceTotal = Invoice::getTotalOrder($id);
        return view('admin.invoice.detail',compact('invoiceDetail','invoiceTotal'));
    }
    public function getActiveInvoice($id=0)
    {
        
            if(!empty($id)){
                Invoice::ActiveInvoice($id);
                return redirect()->route('invoice')->with('msg','Hoàn tất');
            }
            else{
                return redirect()->route('invoice');
           
        }
    }
    public function getInactiveInvoice($id=0)
    {
        
            if(!empty($id)){
                Invoice::InactiveInvoice($id);
                return redirect()->route('invoice')->with('msg','Cập nhật thành công ');
            }
            else{
                return redirect()->route('invoice');
           
        }
    }
    public function getConFirmInvoice($id=0)
    {
    
            if(!empty($id)){
                $email = Invoice::emailInvoice($id);
                $email=$email->email;

                $send = Invoice::sendInvoice($id);
         
                foreach ($send as $key => $item)
                {
    
                    $data = [
                        'invoice_id' => $item->invoice_id,
                        'total' => $item->total,
                        'address' => $item->address,
                        'customer_name' => $item->customer_name,
                        'ship' => $item->ship,
                        'total_bill' => $item->total_bill,
                    ];
                }
                $new_send = Invoice::new_sendInvoice($id);
                $new_data = array();
               
                foreach ($new_send as $key => $item)
                {
                    $new_data[] = [
                        'image' => $item->image,
                        'product_name' => $item->product_name,
                        'volume' => $item->volume,
                        'quantity' => $item->quantity,
                        'total' => $item->total,
                        'price' => $item->price,
                    ];
                }

                $mail = new SendInvoice($data,$new_data);
                Mail::to($email)->send($mail);
              
                Invoice::ConfirmInvoice($id);
                return redirect()->route('invoice')->with('msg','Cập nhật trạng thái và gửi email thành công');
            }
            else{
                return redirect()->route('invoice');
            }
    }
    public function getCanCelInvoice($id=0)
    {
        
            if(!empty($id)){
                Invoice::CancelInvoice($id);
                return redirect()->route('invoice')->with('msg','Cập nhật trạng thái thành công');
            }
            else{
                return redirect()->route('invoice');
           
        }
    }

}
