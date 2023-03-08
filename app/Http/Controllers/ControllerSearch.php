<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelShowApple;
use Illuminate\Support\Facades\DB;

class ControllerSearch extends Controller
{
    public function searchAuto(Request $request){
        $filter = $request->filter;
        $keyword = $request->keyword;
        if($keyword != ''){
            if($filter == 'all'){
                $product = ModelShowApple::where('name', 'LIKE', '%'.$keyword.'%')
                ->whereNull('delete_at')
                ->get();
                foreach ($product as $value) {
                    echo '<a href="product-details?pid='.$value['id'].'"><li style="background-color: white;/* max-width:610px; *//* min-width: 420px; */ padding: 10px; border-bottom: 1px solid #f8f9fa;"><img style="width: 70px; height: 70px;" src="http://localhost:8080/ThucTapTwo/public/product_images/'.$value['photo_name'].'" alt="">'.$value['name'].'</li></a>';
                }
            }else if($filter == 'Apple'){
                $product = ModelShowApple::where([['name', 'LIKE', '%'.$keyword.'%'], ['manufacturer', 'LIKE', '%'.$filter.'%'], ['delete_at', NULL]])
                ->whereNull('delete_at')
                ->get();
                foreach ($product as $value) {
                    echo '<a href="product-details?pid='.$value['id'].'"><li style="background-color: white;/* max-width:610px; *//* min-width: 420px; */ padding: 10px; border-bottom: 1px solid #f8f9fa;"><img style="width: 70px; height: 70px;" src="http://localhost:8080/ThucTapTwo/public/product_images/'.$value['photo_name'].'" alt="">'.$value['name'].'</li></a>';
                }
            }
            else if($filter == 'Samsung'){
                $product = ModelShowApple::where([['name', 'LIKE', '%'.$keyword.'%'], ['manufacturer', 'LIKE', '%'.$filter.'%'], ['delete_at', NULL]])
                ->whereNull('delete_at')
                ->get();
                foreach ($product as $value) {
                    echo '<a href="product-details?pid='.$value['id'].'"><li style="background-color: white;/* max-width:610px; *//* min-width: 420px; */ padding: 10px; border-bottom: 1px solid #f8f9fa;"><img style="width: 70px; height: 70px;" src="http://localhost:8080/ThucTapTwo/public/product_images/'.$value['photo_name'].'" alt="">'.$value['name'].'</li></a>';
                }
            }
            else if($filter == 'Oppo'){
                $product = ModelShowApple::where([['name', 'LIKE', '%'.$keyword.'%'], ['manufacturer', 'LIKE', '%'.$filter.'%'], ['delete_at', NULL]])
                ->whereNull('delete_at')
                ->get();
                foreach ($product as $value) {
                    echo '<a href="product-details?pid='.$value['id'].'"><li style="background-color: white;/* max-width:610px; *//* min-width: 420px; */ padding: 10px; border-bottom: 1px solid #f8f9fa;"><img style="width: 70px; height: 70px;" src="http://localhost:8080/ThucTapTwo/public/product_images/'.$value['photo_name'].'" alt="">'.$value['name'].'</li></a>';
                }
            }
            else if($filter == 'Xiaomi'){
                $product = ModelShowApple::where([['name', 'LIKE', '%'.$keyword.'%'], ['manufacturer', 'LIKE', '%'.$filter.'%'], ['delete_at', NULL]])
                ->whereNull('delete_at')
                ->get();
                foreach ($product as $value) {
                    echo '<a href="product-details?pid='.$value['id'].'"><li style="background-color: white;/* max-width:610px; *//* min-width: 420px; */ padding: 10px; border-bottom: 1px solid #f8f9fa;"><img style="width: 70px; height: 70px;" src="http://localhost:8080/ThucTapTwo/public/product_images/'.$value['photo_name'].'" alt="">'.$value['name'].'</li></a>';
                }
            }
            else if($filter == 'VSmart'){
                $product = ModelShowApple::where([['name', 'LIKE', '%'.$keyword.'%'], ['manufacturer', 'LIKE', '%'.$filter.'%'], ['delete_at', NULL]])
                ->whereNull('delete_at')
                ->get();
                foreach ($product as $value) {
                    echo '<a href="product-details?pid='.$value['id'].'"><li style="background-color: white;/* max-width:610px; *//* min-width: 420px; */ padding: 10px; border-bottom: 1px solid #f8f9fa;"><img style="width: 70px; height: 70px;" src="http://localhost:8080/ThucTapTwo/public/product_images/'.$value['photo_name'].'" alt="">'.$value['name'].'</li></a>';
                }
            }
        }
    }

    //Hàm tìm kiếm sp bình thường
    public function searchResult(Request $request){
        $filter = $request->filter_product;
        $keyword = $request->keyword_search;
        if($filter == 'all'){
            $shop = ModelShowApple::
            join('discount', 'product.discount_id', '=', 'discount.id')
            ->select('product.*', 'discount.discount_percent', 'discount.active')
            ->where('product.name', 'LIKE', '%'.$keyword.'%')
            ->whereNull('product.delete_at')
            ->get();
        }else if($filter == 'Apple'){
            $shop = ModelShowApple::
            join('discount', 'product.discount_id', '=', 'discount.id')
            ->select('product.*', 'discount.discount_percent', 'discount.active')
            ->where([['product.manufacturer', 'LIKE', '%'.$filter.'%'], ['product.name', 'LIKE', '%'.$keyword.'%']])
            ->whereNull('product.delete_at')
            ->get();
        }else if($filter == 'Oppo'){
            $shop = ModelShowApple::
            join('discount', 'product.discount_id', '=', 'discount.id')
            ->select('product.*', 'discount.discount_percent', 'discount.active')
            ->where([['product.manufacturer', 'LIKE', '%'.$filter.'%'], ['product.name', 'LIKE', '%'.$keyword.'%']])
            ->whereNull('product.delete_at')
            ->get();
        }else if($filter == 'Xiaomi'){
            $shop = ModelShowApple::
            join('discount', 'product.discount_id', '=', 'discount.id')
            ->select('product.*', 'discount.discount_percent', 'discount.active')
            ->where([['product.manufacturer', 'LIKE', '%'.$filter.'%'], ['product.name', 'LIKE', '%'.$keyword.'%']])
            ->whereNull('product.delete_at')
            ->get();
        }else if($filter == 'VSmart'){
            $shop = ModelShowApple::
            join('discount', 'product.discount_id', '=', 'discount.id')
            ->select('product.*', 'discount.discount_percent', 'discount.active')
            ->where([['product.manufacturer', 'LIKE', '%'.$filter.'%'], ['product.name', 'LIKE', '%'.$keyword.'%']])
            ->whereNull('product.delete_at')
            ->get();
        }else if($filter == 'Samsung'){
            $shop = ModelShowApple::
            join('discount', 'product.discount_id', '=', 'discount.id')
            ->select('product.*', 'discount.discount_percent', 'discount.active')
            ->where([['product.manufacturer', 'LIKE', '%'.$filter.'%'], ['product.name', 'LIKE', '%'.$keyword.'%']])
            ->whereNull('product.delete_at')
            ->get();
        }
        return view('search-product', ['result'=>$shop]);
    }
}
