<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Invoice extends Model
{
    use HasFactory;
    protected $table = 'cart';

    public static function postPayment($data)
    {
    
        date_default_timezone_set("Asia/Ho_Chi_Minh");

    if(auth::check())
    {
        $userId = auth::user()->id;
    }
    $customer_name = $data[0];
    $email = $data[1];
    $address= $data[2];
    $phone = $data[3];
    $status = 0;
    $created_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
    $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
    $ship = 40000;
    
    $staff_id = 1; // Nếu bạn muốn gán nhân viên cố định, hãy thay đổi giá trị này

    // Tính tổng tiền từ bảng cart
    $total = DB::table('cart')
        ->where('userId', $userId)
        ->sum('total_price');

    // Tính tổng cộng
    $total_bill = $total + $ship;

    // Thêm hóa đơn vào bảng invoice
    $invoiceId = DB::table('invoice')->insertGetId([
        'staff_id' => $staff_id,
        'userId' => $userId,
        'status' => $status,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
        'email' => $email,
        'total' => $total,
        'address' => $address,
        'customer_name' => $customer_name,
        'phone' => $phone,
        'ship' => $ship,
        'total_bill' => $total_bill
    ]);

    // Lấy danh sách các sản phẩm trong giỏ hàng
    $cartItems = DB::table('cart')
        ->where('userId', $userId)
        ->get();

    // Thêm chi tiết hóa đơn cho từng sản phẩm trong giỏ hàng
    foreach ($cartItems as $item) {
        DB::table('invoicedetail')->insert([
            'productsize_id' => $item->productsize_id,
            'invoice_id' => $invoiceId,
            'price' => $item->price,
            'quantity' => $item->quantity,
            'total' => $item->total_price
        ]);
    }

    // Xóa các mục trong giỏ hàng sau khi đã tạo hóa đơn
    DB::table('cart')->where('userId', $userId)->delete();
    }
    public static function getInvoiceByUserId()
    {
        if(auth::check())
        {
            $userId = auth::user()->id;
        }
        $invoice = DB::table('invoice')
        ->select('invoice_id' , 'created_at' ,'status','total_bill')
        ->orderBy('invoice_id','ASC')
        ->orWhere('userId','=',$userId)
        ->get();

        return  $invoice ;
    }
    
    public static function getDetailInvoice($id)
    {
        $detailinvoice = DB::table('invoicedetail')
        ->join('invoice','invoice.invoice_id','=','invoicedetail.invoice_id')
        ->join('productsize','invoicedetail.productsize_id','=','productsize.productsize_id')
        ->join('product','product.product_id','=','productsize.product_id')
        ->join('size','size.size_id','=','productsize.size_id')
        ->orWhere('invoicedetail.invoice_id','=',$id)
        ->select('invoicedetail.*' , 'product.product_name' , 'productsize.productsize_id' , 'product.product_id','size.volume')

        ->get();
      
        return $detailinvoice ;
      
    }

    public static function getInvoice($filters = [],$keywords=null,$perPage = null)
    {
        $invoice = DB::table('invoice')
        ->join('staff','staff.staff_id','=','invoice.staff_id')
        ->join('users','users.id','=','staff.userId')
        ->select('invoice.*','staff_name','invoice.status as invoice_status')
        ->orderBy('invoice.updated_at','ASC');

    
        
        if(!empty($filters)){
            $invoice = $invoice->where($filters);  
        }
        if(!empty($keywords)){
            $invoice = $invoice->where(function($query) use($keywords){
                $query->orWhere('customer_name','like','%'.$keywords.'%');
                $query->orWhere('invoice_id','like','%'.$keywords.'%');
                $query->orWhere('invoice.staff_id','like','%'.$keywords.'%');
                $query->orWhere('staff_name','like','%'.$keywords.'%');
                $query->orWhere('invoice.userId','like','%'.$keywords.'%');
                $query->orWhere('invoice.address','like','%'.$keywords.'%');
                $query->orWhere('invoice.email','like','%'.$keywords.'%');
                $query->orWhere('invoice.created_at','like','%'.$keywords.'%');
                $query->orWhere('invoice.updated_at','like','%'.$keywords.'%');
            });  
        }
        if(!empty($perPage)){
            $invoice = $invoice->paginate($perPage)->withQueryString();

        }else{
             $invoice = $invoice->get();
        }
        return $invoice;
    }
    public static function getDetailByInvoice($id=0)
    {
        
        $invoice = DB::table('invoicedetail')
        ->select('invoicedetail.*','invoicedetail.total as total_product')
        ->Where('invoice_id','=',$id)
        ->orderBy('invoicedetail_id','ASC')
        ->get();

        return $invoice;
    }

    public static function getTotalOrder($id=0)
    {
       
        $total = DB::table('invoice')    
        ->Where('invoice_id','=',$id)
        ->select('invoice.total','invoice.total_bill')
        ->first();
        return $total;
    }
    public static function ActiveInvoice($id=0)
    {
        dd($id);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        if(auth::check())
        {
            $userId = auth::user()->id;
        }
        $staff_id = DB::table('staff')
        ->select('staff.staff_id')
        ->join('users','users.id','=','staff.userId')
        ->Where('users.id','=',$userId)
        ->first();
        dd($staff_id->staff_id);

        DB::table('invoice')
        ->where('invoice_id', $id)
        ->update([
            'staff_id' => $staff_id->staff_id,   
            'updated_at' => $updated_at, 
            'status' => 1,
        ]);
    }
    public static function InactiveInvoice($id=0)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        if(auth::check())
        {
            $userId = auth::user()->id;
        }
        $staff_id = DB::table('staff')
        ->select('staff.staff_id')
        ->join('users','users.id','=','staff.userId')
        ->Where('users.id','=',$userId)
        ->first();

        DB::table('invoice')
        ->where('invoice_id', $id)
        ->update([
            'staff_id' => $staff_id->staff_id,   
            'updated_at' => $updated_at, 
            'status' => 2,
        ]);
    }
    public static function ConfirmInvoice($id=0)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        if(auth::check())
        {
            $userId = auth::user()->id;
        }
        $staff_id = DB::table('staff')
        ->select('staff.staff_id')
        ->join('users','users.id','=','staff.userId')
        ->Where('users.id','=',$userId)
        ->first();

        DB::table('invoice')
        ->where('invoice_id', $id)
        ->update([
            'staff_id' => $staff_id->staff_id,   
            'updated_at' => $updated_at, 
            'status' => 3,
        ]);
    }
    public static function CancelInvoice($id=0)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        if(auth::check())
        {
            $userId = auth::user()->id;
        }
        $staff_id = DB::table('staff')
        ->select('staff.staff_id')
        ->join('users','users.id','=','staff.userId')
        ->Where('users.id','=',$userId)
        ->first();

        DB::table('invoice')
        ->where('invoice_id', $id)
        ->update([
            'staff_id' => $staff_id->staff_id,   
            'updated_at' => $updated_at, 
            'status' => 4,
        ]);
    }

    public static function sendInvoice($id=0)
    {
        $invoice = DB::table('invoice')
        ->select('invoice_id','total','address','customer_name','ship','total_bill')
        ->orWhere('invoice_id','=',$id)
        ->get();

        return $invoice;
    }

    public static function new_sendInvoice($id=0)
    {
         $detail = DB::table('invoicedetail')
        ->select('invoicedetail.*','product.image','product.product_name','productsize.price','size.volume')
        ->join('productsize','productsize.productsize_id','=','invoicedetail.productsize_id')
        ->join('product','product.product_id','=','productsize.product_id')
        ->join('size','size.size_id','=','productsize.size_id')
        ->Where('invoice_id','=',$id)
        ->get();
        return  $detail;
    }

    public static function emailInvoice($id=0)
    {
        return DB::table('invoice')    
        ->Where('invoice_id','=',$id)
        ->select('email')
        ->first();
    }
}
