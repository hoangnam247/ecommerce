<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    const _PER_PAGE = 6;
    public function __construct() {
        $this->size = new Size();
    }

    
    public function getSize(Request $request)
    {
        $keywords = null;
    
        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $sizeList = Size::getSizeAdmin($keywords,self::_PER_PAGE);
        return view('admin.size',compact('sizeList'));
    }
    public function getAdd()
    {
        return view('admin.size.add');
    }
    public function postAdd(Request $request)
    {
    
       
        $rules = [
            'volume'  => 'required|min:3',
        ];

        $messages = [

            'volume.required' => 'Tên size bắt buộc phải nhập ',
            'volume.min' => 'Tên size không được nhỏ hơn :min ký tự',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
 
                $dataInsert = [
                    $request->volume,
                ];

                Size::addSize($dataInsert);
                return redirect()->route('size')->with('msg','Thêm size thành công');
        }
        return back()->withErrors($validator); 
    }
    public function getEdit($id=0)
    {
        if(!empty($id)){
            $sizeDetail = Size::getDetail($id);
        }else{
            return redirect()->route('size')->with('msg','Liên kết không tồn tại');
        } 
        return view('admin.size.edit',compact('sizeDetail'));

    }
    public  function postEdit(Request $request,$id=0)
    {
        
        $rules = [
            'volume'  => 'required|min:3',

        ];

        $messages = [
           
            'volume.required' => 'Tên size bắt buộc phải nhập ',
            'volume.min' => 'Tên size không được nhỏ hơn :min ký tự',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
          
                $dataUpdate = [

                    $request->volume,
            
                ];
                Size::updateSize($dataUpdate, $id);
                return redirect()->route('size')->with('msg','Cập nhật size thành công');
        }
     
    }
    public function getDelete($id)
    {
      
        if(!empty($id)){
            Size::deleteSize($id);
            return redirect()->route('size')->with('msg','Xóa size thành công');
        }
        else{
            return redirect()->route('size');
        }
            
    }
}
