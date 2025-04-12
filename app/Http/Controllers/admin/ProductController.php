<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProductController extends Controller
{
    //
    private $product;
    const _PER_PAGE = 6;
    const _PER_PAGE_Home = 4;
    public function __construct() {
        $this->product = new Product();
        $this->category = new Category();
        $this->size = new Size();
    }

    
    
    public function getProduct(Request $request)
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
            $filters[]=['product.status','=',$status];
        }


        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
   
        $productList = Product::getProductAdmin($filters,$keywords, self::_PER_PAGE);
        return view('admin.product',compact('productList'));
    }
    public function getAll()
    {
       
        return view('home.allproduct');
    }
    

    public function getAdd()
    {
        $categoryList = Category::getCategoryAdmin($keywords = '',$perPage = null);
        $sizeList = Size::getSize();
        return view('admin.product.add',compact('categoryList','sizeList'));
    }
    public function postAdd(Request $request)
    {
    
        if($request->file_upload != null)
        {
            if($request->has('file_upload'))
            {
                $file = $request->file_upload;
                $file_name = $file->getClientoriginalName();
                $file->move(public_path('uploads'),$file_name);
            }
            $request->merge(['productImages'=>$file_name]);
        }
        $rules = [
            
            'category_id' => 'required',
            'productImages' => 'required',
            'product_name'  => 'required|min:3',
            'quantity'  => 'required|integer', 
            'price'  => 'required|integer', 

        ];

        $messages = [
            'category_id.required' => 'Category bắt buộc phải nhập',
            'productImages.required' => 'Ảnh sản phẩm bắt buộc phải nhập ',
            'product_name.required' => 'Tên sản phẩm bắt buộc phải nhập ',
            'product_name.min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
            'price.required' => 'Đơn giá sản phẩm bắt buộc phải nhập ',
            'price.integer' => 'Đơn giá sản phẩm phải là số ',
            'quantity.required' => 'Đơn giá sản phẩm bắt buộc phải nhập ',
            'quantity.integer' => 'Đơn giá sản phẩm phải là số ',
  
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
            $currentDateTime = Carbon::now();
                $dataInsert = [
                    $request->category_id,
                    $request->productImages,
                    $request->product_name,
                    $request->quantity,
                    $request->price,
                    $request->description,
                    $currentDateTime,
                    1
                ];

                Product::addProduct($dataInsert);
                return redirect()->route('product');
        }
        return back()->withErrors($validator); 
    }
    public function getEdit($id=0)
    {
        if(!empty($id)){
            $productDetail = Product::getEdit($id);
            
        }else{
            return redirect()->route('pets')->with('msg','Liên kết không tồn tại');
        } 
        $categoryList = Category::getCategoryAdmin($keywords = '',$perPage = null);
        $sizeList = Size::getSize();
        return view('admin.product.edit',compact('categoryList','sizeList','productDetail'));

    }
    public function getDetail($id,Request $request)
    {
        if(!empty($id)){
            
            $productList = Product::getDetail($id);
        }else{
            return redirect()->route('product')->with('msg','Liên kết không tồn tại');
        } 
        $categoryList = Category::getCategoryAdmin($keywords = null,$perPage = null);
        $sizeList = Size::getSizeByProduct($id);
        return view('admin.product.detail',compact('categoryList','sizeList','productList'));

    }
    public  function postDetail(Request $request,$id=0)
    {
        
        $rules = [

            'quantity'  => 'required|integer', 
            'price'  => 'required|integer', 
            'size_id' => 'required|integer',  // Ensure this rule exists if you need to validate size_id
        ];

        $messages = [
            'price.required' => 'Đơn giá sản phẩm bắt buộc phải nhập ',
            'price.integer' => 'Đơn giá sản phẩm phải là số ',
            'quantity.required' => 'Số lượng sản phẩm bắt buộc phải nhập ',
            'quantity.integer' => 'Số lượng sản phẩm phải là số ',
            'size_id.required' => 'Kích thước sản phẩm bắt buộc phải chọn', // Add this if size_id is required
            'size_id.integer' => 'Kích thước sản phẩm phải là số', // And this
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
                $dataAdd = [
                    $request->size_id,
                    $request->quantity,
                    $request->price,
                    $request->status,
                ];
                Product::addProductSize($dataAdd, $id);
                return redirect()->route('detailProduct', ['id' => $id])->with('msg', 'Thêm sản phẩm thành công ');
            }
     
    }

    public  function postEdit(Request $request,$id=0)
    {
        if($request->file_upload != null)
        {
            if($request->has('file_upload'))
            {
                $file = $request->file_upload;
                $file_name = $file->getClientoriginalName();
                $file->move(public_path('uploads'),$file_name);
            }
            $request->merge(['productImages'=>$file_name]);
        }
        $rules = [
            'category_id' => 'required',
            'product_name'  => 'required|min:3',
        ];

        $messages = [
            'category_id.required' => 'Category bắt buộc phải nhập',
            'product_name.required' => 'Tên sản phẩm bắt buộc phải nhập ',
            'product_name.min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
            $currentDateTime = Carbon::now();
                $dataUpdate = [
                    $request->category_id,
                    $request->productImages,
                    $request->product_name,
                    $request->description,
                    $currentDateTime,
                    $request->status,
                ];
                Product::updateProduct($dataUpdate, $id);
                return redirect()->route('product')->with('msg','Cập nhật thú cưng thành công');
        }
     
    }
    public function getDelete($id=0)
    {
      
        if(!empty($id)){
            Product::deleteProduct($id);
            return redirect()->route('product')->with('msg','Xóa sản phẩm thành công');
        }
        else{
            return redirect()->route('product');
        }
            
    }
    public function getEditStatus($id=0)
    {
      
        if(!empty($id)){

            $productDetail = Product::getDetailBySize($id);
        }else{
            return redirect()->route('product')->with('msg','Liên kết không tồn tại');
        } 
        return view('admin.product.editproductsize',compact('productDetail'));

    }
    
    public  function postEditStatus(Request $request,$id=0)
    {
        
        $rules = [
            'quantity'  => 'required|integer', 
            'price'  => 'required|integer', 
        ];

        $messages = [
            'price.required' => 'Đơn giá sản phẩm bắt buộc phải nhập ',
            'price.integer' => 'Đơn giá sản phẩm phải là số ',
            'quantity.required' => 'Số lượng sản phẩm bắt buộc phải nhập ',
            'quantity.integer' => 'Số lượng sản phẩm phải là số ',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
                $dataAdd = [
                    $request->quantity,
                    $request->price,
                    $request->status,
                ];
                Product::updateProductSize($dataAdd, $id);
                return redirect()->route('product')->with('msg', 'Cập nhật thành công ');
            }
     
    }
    public function getDetailProduct($id=0,Request $request)
    {   

        $product = $this->product->getDetailProduct($id);
        $size = $this->product->getSize($id);
        return view('home.detailproduct', compact('product','size'));
    }
    public function getPrice(Request $request)
    {
    $productId = $request->input('productId');
    $sizeId = $request->input('sizeId');
    // Lấy giá từ cơ sở dữ liệu dựa trên productId và sizeId
    $price = Product::getPrice($productId,$sizeId);
    if (!$price) {
        return response()->json(['error' => 'No matching product size found'], 404); // Handling the case where no price is found
    }

    // Assuming the price object includes 'price' and 'productsize_id' fields
    return response()->json([
        'price' => $price->price, 
        'productsize_id' => $price->productsize_id
    ]);
    }

    public function  getCollections(Request $request)
    {
        $product = new Product();
        $filters = [];
        $keywords = null;
        if(!empty($request->trangthai))
        {
            $trangthai = $request->trangthai;
            if($trangthai=='active'){
                $trangthai = 1;
            }else if($trangthai=='delete'){
                $trangthai = 3;
            }else{
                $trangthai = 0;
            }
            $filters[]=['product.status','=',$trangthai];
        }
        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $categoryList = Category::getCategoryAdmin($keywords = '',$perPage = null);
        $productList = Product::getProduct($filters,$keywords, self::_PER_PAGE_Home);
        return view('home.allproduct',compact('productList','categoryList'));
    }
    
    public function getCollectionsByCategory(Request $request,$id)
    {
        $product = new Product();
        $filters = [];
        $keywords = null;
        if(!empty($request->trangthai))
        {
            $trangthai = $request->trangthai;
            if($trangthai=='active'){
                $trangthai = 1;
            }else if($trangthai=='delete'){
                $trangthai = 3;
            }else{
                $trangthai = 0;
            }
            $filters[]=['product.status','=',$trangthai];
        }
        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $categoryList = Category::getCategoryAdmin($keywords = '',$perPage = null);
        $productList = Product::getCollectionsByCategory($filters,$keywords, self::_PER_PAGE_Home,$id);
        return view('home.allproduct',compact('productList','categoryList'));
    }
   
}
