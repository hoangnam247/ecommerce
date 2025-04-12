<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Customer extends Model
{

    use HasFactory;
    public function addCustomer($data)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $fullname = $data[0];
        $email = $data[1];
        $password = $data[2];
        $password = bcrypt($password);
        $level = 3;
        $status = 1;
        $created_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        $userId = DB::table('users')->insertGetId([
            'users_name' => $fullname,
            'email' => $email,
            'password' => $password,
            'level' => $level,
            'status' => $status,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);       

        DB::table('customer')->insert([
            'customer_name' => $fullname,
            'email' => $email,
            'userId' => $userId,
        ]);
        
    }
    public static function getDetailByCustomer()
    {

        if (Auth::check()) {
            $userId = Auth::user()->id;
        

        $detailcustomer = DB::table('customer')
        ->join('users','users.id','=','customer.userId')
        ->orWhere('customer.userId','=',$userId)
        ->select('customer.*' , 'users.*' )
        ->first();

        }
        return $detailcustomer ;
      
    }
    public static function getUpdate($data,$id)
    {
     

        if (Auth::check()) {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $userId = Auth::user()->id;
            DB::table('customer')
            ->where('customer_id', $id)
            ->update([
                'customer_name' => $data[0],
                'phone' => $data[1],    
                'address' => $data[2],
            ]);
            $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'users_name' => $data[0],
                    'updated_at' => $updated_at,
                ]);
        }
       
    }
    
    public static function getCustomer($filters = [],$keywords=null,$perPage = null)
    {
        $customer = DB::table('customer')
        ->select('customer.*','users.*')
        ->join('users', '.users.id', '=', 'customer.userId')
        ->where('users.status', '!=', '3')
        ->orderBy('customer_id','ASC');
        if(!empty($filters)){
            $customer = $customer->where($filters);  
        }
        if(!empty($keywords)){
            $customer = $customer->where(function($query) use($keywords){
                $query->orWhere('customer_id','like','%'.$keywords.'%');
                 $query->orWhere('customer_name','like','%'.$keywords.'%');
                 $query->orWhere('customer.email','like','%'.$keywords.'%');

            });  
        }
        if(!empty($perPage)){
            $customer = $customer->paginate($perPage)->withQueryString();

        }else{
             $customer = $customer->get();
        }
     
        return $customer;
    }

    public static function editStatus($id,$status)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        DB::table('users')
        ->join('customer', 'users.id', '=', 'customer.userId')
        ->where('customer.customer_id', $id)
        ->update([
            'status' => $status,  
            'updated_at' => $updated_at,
        ]);

    }
    public static function deleteCustomer($id)
    {   
        $status = 3;
        DB::table('users')
            ->join('customer', 'users.id', '=', 'customer.userId')
            ->where('customer.customer_id', $id)
            ->update([
                'users.status' => $status,
            ]);        
           
    }
}
