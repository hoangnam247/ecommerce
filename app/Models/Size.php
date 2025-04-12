<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Size extends Model
{
    use HasFactory;
    protected $table = 'size';
    public static function getSize()
    {
        $size = DB::table('size')
        ->select('size.*')
        ->orderBy('size_id','ASC');
    
        $size = $size->get();
    
        return $size;
    }
    public static function getSizeByProduct($id)
    {
        // Query to select all sizes that are not linked to the specified product ID
        $sizes = DB::table('size')
            ->select('size.size_id', 'size.volume')  
            ->leftJoin('productsize', function ($join) use ($id) {
                $join->on('size.size_id', '=', 'productsize.size_id')
                     ->where('productsize.product_id', '=', $id);
            })
            ->whereNull('productsize.size_id')  // Important: Selects only sizes not linked to this product
            ->orderBy('size.size_id', 'ASC')
            ->get();
    
        return $sizes;
    }
    public static function getSizeAdmin($keywords,$perPage = null)
    {
        $size =  DB::table('size')
        ->select('size.*')
        ->orderBy('size_id','ASC');
        if(!empty($keywords)){
            $size = $size->where(function($query) use($keywords){
                $query->orWhere('size_id','like','%'.$keywords.'%');
                $query->orWhere('volume','like','%'.$keywords.'%');

            });  
        }
        if(!empty($perPage)){
            $size = $size->paginate($perPage)->withQueryString();

        }else{
             $size = $size->get();
        }

        return $size;
    }

    public static function addSize($size){

        $size = DB::table('size')->insertGetId([
            'volume' => $size[0],
        ]);
        return $size;

    
    }
    public static function getDetail($id)
    {
        $size = DB::table('size')
    ->select('size.*')
    ->where('size.size_id', '=', $id)
    ->first();
        return $size;
    }

    public static function updateSize($size, $id) {

            DB::table('size')
            ->where('size_id', $id)
            ->update([
                'volume' => $size[0],
            ]);

        
    }
    
}
