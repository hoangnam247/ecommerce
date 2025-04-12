<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    use HasFactory;
    public static function getProductAdmin($filters = [],$keywords=null,$perPage = null)
    {
        $product = DB::table('product')
        ->select(
            'product.*',
            'product.status as product_status',
            'category.*',
        )
        ->where('product.status', '!=', '3')
        ->join('category', 'product.category_id', '=', 'category.category_id')
        ->orderBy('product.product_id', 'ASC');

        if(!empty($filters)){
            $product = $product->where($filters);  
        }

        if(!empty($keywords)){
            $product = $product->where(function($query) use($keywords){
                $query->orWhere('product.product_id','like','%'.$keywords.'%');
                $query->orWhere('product.product_name','like','%'.$keywords.'%');
            });  
        }
        if(!empty($perPage)){
            $product = $product->paginate($perPage)->withQueryString();

        }else{
             $product = $product->get();
        }

        return $product;
    }
    public static function getProduct($filters = [],$keywords=null,$perPage = null)
    {
        $product = DB::table('product')
        ->select('category.category_name','product.product_name','product.product_id', 'product.image', 'productsize.price', 'size.volume')
        ->join('productsize', 'productsize.product_id', '=', 'product.product_id')
        ->join('size', 'size.size_id', '=', 'productsize.size_id')
        ->join('category', 'category.category_id', '=', 'product.category_id')
        ->joinSub(
            DB::table('productsize')
                ->join('size', 'size.size_id', '=', 'productsize.size_id')
                ->select('productsize.product_id', DB::raw('MIN(size.volume) as min_volume'))
                ->groupBy('productsize.product_id'),
            'min_volume_query',
            function ($join) {
                $join->on('product.product_id', '=', 'min_volume_query.product_id')
                     ->on('size.volume', '=', 'min_volume_query.min_volume');
            }
        )
        ->orderBy('product.product_id', 'ASC');
    
    if (!empty($filters)) {
        $product = $product->where($filters);
    }
    if (!empty($keywords)) {
        $product = $product->where(function ($query) use ($keywords) {
            $query->orWhere('product.product_name', 'like', '%' . $keywords . '%');
        });
    }
    if (!empty($perPage)) {
        $product = $product->paginate($perPage)->withQueryString();
    } else {
        $product = $product->get();
    }
    
    return $product;
    }

    public static function getCollectionsByCategory($filters = [],$keywords=null,$perPage = null,$id)
    {
        $product = DB::table('product')
        ->select('category.category_name','product.product_name','product.product_id', 'product.image', 'productsize.price', 'size.volume')
        ->join('productsize', 'productsize.product_id', '=', 'product.product_id')
        ->join('size', 'size.size_id', '=', 'productsize.size_id')
        ->join('category', 'category.category_id', '=', 'product.category_id')
        ->joinSub(
            DB::table('productsize')
                ->join('size', 'size.size_id', '=', 'productsize.size_id')
                ->select('productsize.product_id', DB::raw('MIN(size.volume) as min_volume'))
                ->groupBy('productsize.product_id'),
            'min_volume_query',
            function ($join) {
                $join->on('product.product_id', '=', 'min_volume_query.product_id')
                     ->on('size.volume', '=', 'min_volume_query.min_volume');
            }
        )
        ->where('product.category_id', '=', $id) // Filter by category_id
        ->orderBy('product.product_id', 'ASC');
    
    if (!empty($filters)) {
        $product = $product->where($filters);
    }
    if (!empty($keywords)) {
        $product = $product->where(function ($query) use ($keywords) {
            $query->orWhere('product.product_name', 'like', '%' . $keywords . '%');
        });
    }
    if (!empty($perPage)) {
        $product = $product->paginate($perPage)->withQueryString();
    } else {
        $product = $product->get();
    }
    
    return $product;
    }
    public static function addProduct($product){

        $productID = DB::table('product')->insertGetId([
            'product_name' => $product[2],
            'description' => $product[5],    
            'created_at' => $product[6],
            'updated_at' => $product[6],
            'image' => $product[1],
            'category_id' => $product[0],    
        ]);

        DB::table('productsize')->insertGetId([
            'product_id' => $productID,
            'quantity' => $product[3],
            'price' => $product[4],
            'status' => $product[7],
        ]);
    }
    public static  function getEdit($id)
    {
        $product = DB::table('productsize')
    ->select('productsize.*', 'product.*', 'size.*')
    ->join('product', 'productsize.product_id', '=', 'product.product_id')
    ->join('size', 'productsize.size_id', '=', 'size.size_id')
    ->where('product.product_id', '=', $id)
    ->first();
       
        return $product;
    }
    public static  function getDetailBySize($id)
    {
        $product = DB::table('productsize')
    ->select('productsize.*', 'productsize.status as productsize_status', 'product.*', 'size.*')
    ->join('product', 'productsize.product_id', '=', 'product.product_id')
    ->join('size', 'productsize.size_id', '=', 'size.size_id')
    ->where('productsize.productsize_id', '=', $id)
    ->first();
       
        return $product;
    }
    public static  function getDetail($id)
    {
        $product = DB::table('productsize')
    ->select(
        'productsize.*', // Select all columns from productsize
        'product.product_id', // Alias for product_id from product, removed the space after product_id
        'product.product_name', // Alias for name from product, removed the space after product_name
        'product.image', // Alias for name from product, removed the space after product_name
        'size.*', // Select all columns from size
        'productsize.status as productsize_status' // Alias for status from productsize
    )
    ->join('product', 'productsize.product_id', '=', 'product.product_id')
    ->join('size', 'productsize.size_id', '=', 'size.size_id')
    ->where('productsize.product_id', '=', $id)
    ->get();

        return $product;
    }

    public static function addProductSize($dataAdd,$id){

        DB::table('productsize')->insertGetId([
            'product_id' => $id,
            'size_id' => $dataAdd[0],
            'quantity' => $dataAdd[1],
            'price' => $dataAdd[2],
            'status' => $dataAdd[3],
        ]);
    }
    public static function updateProductSize($dataUpdate,$id){

        DB::table('productsize')
        ->where('productsize_id', $id)
        ->update([
            'quantity' => $dataUpdate[0],
            'price' => $dataUpdate[1],    
            'status' => $dataUpdate[2],
        ]);
    }

    public static  function updateProduct($dataUpdate, $id) {


        if($dataUpdate[1]== null)
        {
            DB::table('product')
            ->where('product_id', $id)
            ->update([
                'product_name' => $dataUpdate[2],
                'description' => $dataUpdate[3],    
                'updated_at' => $dataUpdate[4],
                'category_id' => $dataUpdate[0],  
                'status' => $dataUpdate[5],      
            ]);
        }else{
            DB::table('product')
            ->where('product_id', $id)
            ->update([
                'product_name' => $dataUpdate[2],
                'description' => $dataUpdate[3],    
                'updated_at' => $dataUpdate[4],
                'image' => $dataUpdate[1],      
                'category_id' => $dataUpdate[0],  
                'status' => $dataUpdate[5],      
            ]);
        }
        DB::table('productsize')
        ->join('product', 'productsize.product_id', '=', 'product.product_id')
        ->where('product.product_id', $id)
        ->update([
            'productsize.status' => $dataUpdate[5],
        ]);

  
    }
    
    public static function deleteProduct($id)
    {   
        DB::table('product')
        ->where('product_id', $id)
        ->update([
            'status' => 3,      
        ]);

        DB::table('productsize')
        ->join('product', 'productsize.product_id', '=', 'product.product_id')
        ->where('product.product_id', $id)
        ->update([
            'productsize.status' => 3,    
        ]);
    }

    public static  function getDetailProduct($id)
    {
        $product = DB::table('productsize')
        ->select('productsize.*', 'p.*', 'size.*')
        ->join('product as p', 'productsize.product_id', '=', 'p.product_id')
        ->join('size', 'productsize.size_id', '=', 'size.size_id')
        ->where('p.product_id', '=', $id)
        ->first();
        return  $product;
    
    }
    public static function getSize($id)
    {
        $size = DB::table('size')
        ->select('size.*')
        ->join('productsize', 'productsize.size_id', '=', 'size.size_id')
        ->where('productsize.product_id', '=', $id)
        ->where('productsize.status', '=', 1)
        ->get();
        return  $size;
    }
    public  static function getProductByCategory($keywords=null,$perPage = null,$id)
    {

        
        $thucung = DB::table('productsize')
        ->select('thucung.*')
        ->join('loai','thucung.id_loai','=','loai.id_loai')
        ->orWhere('loai.thuoc_loai','=',$id)
        ->Where('thucung.trangthai','=','1');
      
        if(!empty($keywords)){
            $thucung = $thucung->where(function($query) use($keywords){
                $query->orWhere('ten_thucung','like','%'.$keywords.'%');
  
            });  
        }

        if(!empty($perPage)){
            $thucung = $thucung->paginate($perPage)->withQueryString();

        }else{
             $thucung = $thucung->get();
        }

        return $thucung;
    } 

    public static function getPrice($productId,$sizeId)
    {
        $price = DB::table('productsize')
        ->select('productsize.price', 'productsize.productsize_id') // Correct the selection to include only the required fields
        ->join('product', 'productsize.product_id', '=', 'product.product_id')
        ->join('size', 'productsize.size_id', '=', 'size.size_id')
        ->where('product.product_id', '=', $productId)
        ->where('size.size_id', '=', $sizeId)
        ->where('productsize.status', '=', 1)
        ->first();
        return  $price;
    }
    
    
}
