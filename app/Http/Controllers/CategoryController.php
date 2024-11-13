<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
   public function categories()
   {
    
    return view('pages.categories');
    
   }

   public function createCategory()
   {
   
      return view('pages.category.create');
   }

   public function categoryStore(Request $request)
   {


// dd($request->all());

      Category::create([
         //bam dike column name => dan dike input field er name
         'name'=>$request->cat_name,
         // 'description'=>$request->description

      ]);

      //insert into categories ('name','description') values($request->cate_name,$request->description)

      return redirect()->back();

   }
}
