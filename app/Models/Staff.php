<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Staff extends Model
{
    use HasFactory;
    public static function getStaff($filters = [],$keywords,$perPage = null)
    {
        $staff = DB::table('staff')
        ->select('staff.*','users.*')
        ->join('users', '.users.id', '=', 'staff.userId')
        ->where('users.status', '!=', '3')
        ->orderBy('staff_id','ASC');

        if(!empty($filters)){
            $staff = $staff->where($filters);  
        }
        if(!empty($keywords)){
            $staff = $staff->where(function($query) use($keywords){
                $query->orWhere('staff_id','like','%'.$keywords.'%');
                $query->orWhere('staff.staff_name','like','%'.$keywords.'%');

            });  
        }
        if(!empty($perPage)){
            $staff = $staff->paginate($perPage)->withQueryString();

        }else{
             $staff = $staff->get();
        }
     
        return $staff;
    }
    public static function addStaff($dataInsert){

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $created_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        $users = DB::table('users')->insertGetId([
            'users_name' => $dataInsert[0],
            'email' => $dataInsert[4],
            'password' => bcrypt($dataInsert[5]),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'level' => 2, 
            'status' => 1,
        ]);

        $staff = DB::table('staff')->insertGetId([
            'staff_name' => $dataInsert[0],
            'phone' => $dataInsert[1],
            'address' => $dataInsert[2],
            'gender' => $dataInsert[3],
            'userId' => $users,
        ]);
        return $staff;

    
    }
    public static function getDetail($id)
    {
        $staff = DB::table('staff')
            ->select('staff.*','users.*')
            ->join('users', 'users.id', '=', 'staff.userId')
            ->where('staff.staff_id', '=', $id)
            ->first();
            return $staff;
    }

    public static function updateStaff($dataUpdate, $id) {

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $created_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        $updated_at = date("Y-m-d H:i:s"); // Sửa định dạng thời gian
        DB::table('users')
        ->join('staff', 'users.id', '=', 'staff.userId')
        ->where('staff.staff_id', $id)
        ->update([
            'users.users_name' => $dataUpdate[0],
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'users.status' => $dataUpdate[4],
            'users.level' => $dataUpdate[5],
        ]);

        DB::table('staff')
            ->where('staff.staff_id', $id)
            ->update([
                'staff.staff_name' => $dataUpdate[0],
                'phone' => $dataUpdate[1],
                'address' => $dataUpdate[2],
                'gender' => $dataUpdate[3],
            ]);

    }
    
    public static function deleteStaff($id)
    {   
        $status = 3;
        DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.userId')
            ->where('staff.staff_id', $id)
            ->update([
                'users.status' => $status,
            ]);        
           
    }
}
