<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    use HasFactory;


    public static function getCategoryAdmin($filters = [],$keywords,$perPage = null)
    {
        $category =  DB::table('category')
        ->select('category.*')
        ->where('category.status', '!=', '3')
        ->orderBy('category_id','ASC');

        if(!empty($filters)){
            $category = $category->where($filters);  
        }

        if(!empty($keywords)){
            $category = $category->where(function($query) use($keywords){
                $query->orWhere('category_id','like','%'.$keywords.'%');
                $query->orWhere('category_name','like','%'.$keywords.'%');

            });  
        }
        if(!empty($perPage)){
            $category = $category->paginate($perPage)->withQueryString();

        }else{
             $category = $category->get();
        }

        return $category;
    }

    public static function addCategory($category){

        $category = DB::table('category')->insertGetId([
            'category_name' => $category[0],
            'status'        =>  1,
        ]);
        return $category;

    
    }
    public static function getDetail($id)
    {
        $category = DB::table('category')
    ->select('category.*')
    ->where('category.category_id', '=', $id)
    ->first();
        return $category;
    }

    public static function updateCategory($category, $id) {

            DB::table('category')
            ->where('category_id', $id)
            ->update([
                'category_name' => $category[0],
                'status' => $category[1],    
            ]);

            DB::table('productsize')
            ->join('product', 'product.product_id', '=', 'productsize.product_id')
            ->where('product.category_id', $id)
            ->update([
                'productsize.status' => $category[1],  
            ]);

            DB::table('product')
            ->where('product.category_id', $id)
            ->update([
                'product.status' => $category[1],  
            ]);

    }
    
    public  static function deleteCategory($id)
    {   
        $status = 3;
        DB::table('productsize')
            ->join('product', 'product.product_id', '=', 'productsize.product_id') // Sửa '.product.' thành 'product'
            ->join('category', 'product.category_id', '=', 'category.category_id') // Xóa dấu chấm ở đầu '.product'
            ->where('product.category_id', $id)
            ->update([
                'productsize.status' => $status,    
        ]);

        DB::table('product')
        ->where('product.category_id', $id)
        ->update([
            'product.status' => $status,   
        ]);

        DB::table('category')
        ->where('category_id', $id)
        ->update([
            'status' => $status,    
        ]);

    }
}
