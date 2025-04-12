<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';


    public static function addCart($productSizeId,$quantity)
    {

        

        if (Auth::check()) {
            $userId = Auth::user()->id;
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng chưa
            $existingCartItem = DB::table('cart')
                ->where('productsize_id', $productSizeId)
                ->where('userId', $userId)
                ->first();
            
            if ($existingCartItem) {
                // Nếu sản phẩm đã tồn tại, cập nhật số lượng của nó
                $newQuantity = $existingCartItem->quantity + $quantity;
                $newTotalPrice = $existingCartItem->price * $newQuantity;
                
                DB::table('cart')
                    ->where('cart_id', $existingCartItem->cart_id)
                    ->update([
                        'quantity' => $newQuantity,
                        'total_price' => $newTotalPrice
                    ]);
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
                $cart_product = DB::table('productsize')
                    ->select('productsize.price')
                    ->where('productsize.productsize_id', '=', $productSizeId)
                    ->first();
        
                if ($cart_product) {
                    $dongia = $cart_product->price;
                    $thanhtien = $quantity * $dongia;
                    DB::table('cart')->insert([
                        'productsize_id' => $productSizeId,
                        'quantity' => $quantity,
                        'price' => $dongia,
                        'total_price' => $thanhtien,
                        'userId' => $userId
                    ]);
                } else {
                    // Xử lý nếu sản phẩm không tồn tại
                }
            }
        }
    }
    public static function getAllCart()
    {
        if(auth::check())
        {
            $id = auth::user()->id;
        }
        $cart = DB::table('cart')
        ->select('cart.*','product.product_name','product.image','size.volume')
        ->join('productsize','productsize.productsize_id','=','cart.productsize_id')
        ->join('users','users.id','=','cart.userId')
        ->join('product','product.product_id','=','productsize.product_id')
        ->join('size','size.size_id','=','productsize.size_id')
        ->Where('userId','=',$id)
        ->where('productsize.status', '=' ,'1' )
        ->get();

        return $cart;
    }
    public static function updateCart($productSizeId,$quantity)
    {
        $product = DB::table('productsize')
        ->where('productsize_id', $productSizeId)
        ->first();

        $price = $product->price; // Lấy đơn giá của sản phẩm

        // Tính toán thành tiền
        $totalPrice = $price * $quantity;
        
        $cart = DB::table('cart')
        ->where('productsize_id', $productSizeId)
        ->update(['quantity' => $quantity, 'price' => $price, 'total_price' => $totalPrice]);

        return $cart;
    }
    public static function deleteCart($id)
    {
        return DB::delete("DELETE FROM cart WHERE cart_id =?",[$id]);
    }
}
