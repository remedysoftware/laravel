<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
class CategoriesController extends Controller
{
    //

    public function returnCategories(){
        $reteurnCategoriesAll = Categories::get()->toJson(JSON_PRETTY_PRINT);
        return response($reteurnCategoriesAll, 200);
    }

    // RETURN CATEGORY ID BY NAME
    public function returnCategoryIdByName(Request $request){
        if ( isset($request->categoryname) ){
            $categoryname = $request->categoryname;
            if (Categories::where('categories','like', '%'.$categoryname.'%')->exists()) {
                $categorynameSingle = Categories::where('categories','like', '%'.$categoryname.'%')->get('id')->toJson(JSON_PRETTY_PRINT);
                return response($categorynameSingle, 200);
              } else {
                return response()->json([
                  "message" => "No such Category found"
                ], 200);
              }
        }else{
            return response()->json([
                "message" => "No such Category found"
            ],200);
        }
    }
}
