<?php

namespace App\Http\Controllers;
use Function_;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
    	$arrCategory = Category::paginate(10);
    	return view("admin.pages.category_list",["arrCategory"=>$arrCategory]);
    }
    public function delete($id)
    {
    	$category = Category::findOrFail($id);
    	$category->delete();
    	return redirect()->route('categoryList');
    }
    public function edit($id)
    {
    	$category = Category::findOrFail($id);
    	return view("admin.pages.category-edit", ["category"=>$category]);
    }
    public function update(Request $request)
    {
        $this->validate(
            $request, 
            [
                "name"=>"unique:category,name"
            ], 
            [
                "name.unique"=>"Tên loại sản phẩm đã tồn tại"
            ]
        );
        $category = Category::findOrFail(intval($request->input("id")));
        $category->name = $request->input("name");
        $category->unsigned_name = changeTitle($request->input("name"));
        $category->save();
        return redirect()->route("categoryList");
    }
    public function create()
    {
        return view('admin.pages.category-adding');
    }
    public function store(Request $request)
    {
    	$this->validate(
            $request, 
            [
                "name"=>"unique:category,name"
            ], 
            [
                "name.unique"=>"Tên loại sản phẩm đã tồn tại"
            ]
        );
        $category = new Category;
        $category->name = $request->input("name");
        $category->unsigned_name = changeTitle($request->input("name"));
        $category->save();
        return redirect()->route("categoryList");
    }
}
