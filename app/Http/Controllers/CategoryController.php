<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
   public function categories()
   {
    
    $allCategory=Category::paginate(5);
    
    return view('backend.pages.categories',compact('allCategory'));
    
   }

   public function createCategory()
   {
   
      return view('backend.pages.category.create');
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
