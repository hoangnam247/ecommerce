<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Account extends Model
{
    use HasFactory;


    public static function getAccount($filters = [],$keywords,$perPage = null)
    {
        $users = DB::table('users')
        ->select(
            'users.*',
        );
        if(!empty($filters)){
            $users = $users->where($filters);  
        }
        if(!empty($keywords)){
            $users = $users->where(function($query) use($keywords){
                $query->orWhere('id','like','%'.$keywords.'%');
                $query->orWhere('users_name','like','%'.$keywords.'%');
                $query->orWhere('email','like','%'.$keywords.'%');

            });  
        }
        if(!empty($perPage)){
            $users = $users->paginate($perPage)->withQueryString();

        }else{
             $users = $users->get();
        }
        return $users;
    }

    public static function checkAccounts($email)
    {
        return  DB::table('users')
        ->Where('users.email','=',$email)
        ->select('id')
        ->get();
    }
    public static function editStatus($id,$status)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        return    DB::table('users')
        ->where('id', $id)
        ->update([
            'status' => $status,  
            'updated_at' => $updated_at,

        ]);
    }
    public  static function updateAccounts($email,$new_pass)
    {
        $new_pass = bcrypt($new_pass);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        return DB::update(' UPDATE users SET  updated_at = ? , password = ? where email = ? ',array( $updated_at,$new_pass,$email));
    }
    public static function ChangePass($password,$email)
    {
        $password = bcrypt($password);
        return DB::update(' UPDATE users SET  password = ? where email = ? ',array($password,$email));
    }
}
