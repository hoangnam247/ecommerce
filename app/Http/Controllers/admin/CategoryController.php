<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    private $category;  
    const _PER_PAGE = 6;
    public function __construct() {
        $this->category = new Category();
    }

    
    public function getCategory(Request $request)
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
            $filters[]=['category.status','=',$status];
        }

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $categoryList = Category::getCategoryAdmin($filters,$keywords,self::_PER_PAGE);
        return view('admin.category',compact('categoryList'));
    }
    public function getAdd()
    {
        return view('admin.category.add');
    }
    public function postAdd(Request $request)
    {
    
       
        $rules = [
            'category_name'  => 'required|min:3',
        ];

        $messages = [

            'category_name.required' => 'Tên category bắt buộc phải nhập ',
            'category_name.min' => 'Tên category không được nhỏ hơn :min ký tự',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
 
                $dataInsert = [
                    $request->category_name,
                ];

                Category::addCategory($dataInsert);
                return redirect()->route('category')->with('msg','Thêm category thành công');
        }
        return back()->withErrors($validator); 
    }
    public function getEdit($id=0)
    {
        if(!empty($id)){
            $categoryDetail = Category::getDetail($id);
        }else{
            return redirect()->route('category')->with('msg','Liên kết không tồn tại');
        } 
        return view('admin.category.edit',compact('categoryDetail'));

    }
    public  function postEdit(Request $request,$id=0)
    {
        
        $rules = [
            'category_name'  => 'required|min:3',

        ];

        $messages = [
           
            'category_name.required' => 'Tên category bắt buộc phải nhập ',
            'category_name.min' => 'Tên category không được nhỏ hơn :min ký tự',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
          
                $dataUpdate = [

                    $request->category_name,
                    $request->status,
            
                ];
                Category::updateCategory($dataUpdate, $id);
                return redirect()->route('category')->with('msg','Cập nhật category thành công');
        }
     
    }
    public function getDelete($id)
    {
      
        if(!empty($id)){
            Category::deleteCategory($id);
            return redirect()->route('category')->with('msg','Xóa category thành công');
        }
        else{
            return redirect()->route('category');
        }
            
    }
}
