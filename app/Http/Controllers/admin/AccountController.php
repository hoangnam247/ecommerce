<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
   
    const _PER_PAGE = 6;

    
    public function getAccount(Request $request)
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
        $accountList = Account::getAccount($filters,$keywords,self::_PER_PAGE);
        return view('admin.account',compact('accountList'));
    }

    
    public function getEditStatus($id=0,Request $request)
    {
        if(!empty($id)){
            $status = $request->status;
            Account::editStatus($id,$status);
            return redirect()->route('account')->with('msg','Cập nhật status accounts thành công');
        }
        else{
            return redirect()->route('account');
        }
    }
}
