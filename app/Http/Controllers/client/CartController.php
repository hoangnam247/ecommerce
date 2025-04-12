<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Invoice; 
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function __construct()
    {
        $this->cart = new Cart();
        $this->invoice = new Invoice();
    }
    public function getCart(){
      
        $cartList = Cart::getAllCart();
        return view('home.cart',compact('cartList'));
    }

    public function postCart(Request $request)
    {

        try {
            // Lấy thông tin sản phẩm và số lượng từ request
            $productSizeId = $request->input('productSizeId');
            $quantity = $request->input('quantity');
            
            // Kiểm tra xem sản phẩm và số lượng có tồn tại không
            if (!$productSizeId || !$quantity) {
                throw new \Exception("Product size ID or quantity is missing.");
            }

            // Xử lý thêm sản phẩm vào giỏ hàng ở đây

            
            Cart::addCart($productSizeId,$quantity);
            return redirect()->route('home');

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateCart(Request $request){
      

         try {
        // Lấy thông tin sản phẩm và số lượng từ request
        $productSizeId = $request->input('productSizeId');
        $quantity = $request->input('quantity');
        
        // Kiểm tra xem sản phẩm và số lượng có tồn tại không
        if (!$productSizeId || !$quantity) {
            throw new \Exception("Product size ID or quantity is missing.");
        }

        // Cập nhật số lượng trong giỏ hàng ở đây
        // Ví dụ:
        Cart::updateCart($productSizeId,$quantity);
        return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    }

    public function getPayment(){
      
        $cartList = Cart::getAllCart();
        return view('home.payment',compact('cartList'));
    }

    public function postPayment(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'customer_name' => 'required:min3',
            'phone'  => 'required|numeric|min:100000000|max:1000000000',
            'address'  => 'required',
        ];
        $messages = [
            'email.required' => 'Email bắt buộc phải nhập',
            'email.min' => 'Email không hợp lệ',
            'customer_name.required' => 'Tên khách hàng bắt buộc phải nhập',
            'customer_name.min' => 'Tên khách hàng không được nhỏ hơn :min ký tự',
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.numeric' => 'Số điện thoại phải là chữ số',
            'phone.min' => 'Số điện thoại bắt buộc phải 10 chữ số',
            'phone.max' => 'Số điện thoại bắt buộc phải 10 chữ số',
            'address.required' => 'Địa chỉ bắt buộc phải nhập',
          
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->validate();

        if($validator->fails()){
             
                $validator->errors()->add('msg','Da xay ra loi');

        }else{
            $dataInsert = [
                $request->customer_name,
                $request->email,
                $request->address,
                $request->phone,
                
            ];
            Invoice::postPayment($dataInsert);
            return  redirect()->route('personal');
        }
    }
    public function getDelete($id=0)
    {
    
        if(!empty($id)){
            Cart::deleteCart($id);
            return redirect()->route('cart')->with('msg','Xóa thú cưng trong giỏ hàng thành công');
        }
        else{
            return redirect()->route('cart');
        }
            
    }

}
