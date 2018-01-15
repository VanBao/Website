<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Function_;
class ProductController extends Controller
{
    public function index()
    {
    	$arrProduct = Product::paginate(10);
    	return view("admin.pages.product-list",["arrProduct"=>$arrProduct]);
    }
    public function delete($id)
    {
    	$product = Product::findOrFail($id);
        unlink("images/".$product->path);
    	$product->delete();
    	return redirect()->route('productList');
    }
    public function edit($id)
    {
    	$product = Product::findOrFail($id);
    	$arrCategory = Category::all();
        return view("admin.pages.product-edit", ["product"=>$product, "arrCategory"=>$arrCategory]);
    }
    public function update(Request $request)
    {
        $product = Product::findOrFail(intval($request->input("id")));
        if(strcmp($product->name, $request->input("name")) != 0)
        {
            $this->validate($request,
                [
                    'name'=>'unique:product,name',
                    'image'=>'mimes:jpeg,jpg,png,gif'
                ],
                [
                    'name.unique'=>'Tên sản phẩm đã tồn tại',
                    'image.mimes'=>'File ảnh không hợp lệ'
                ]

            );
        }
        else if(!is_null($request->file('photo')))
        {
            $this->validate($request,
                [
                    'image'=>'mimes:jpeg,jpg,png,gif'
                ],
                [
                    'image.mimes'=>'File ảnh không hợp lệ'
                ]

            );
        }
        if(!is_null($request->file("image")))
        {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            while(file_exists("images/".$fileName))
            {
                $fileName = date("YmdHis").$fileName;
            }
            $file->move("images",$fileName);
            unlink("images/".$product->path);
            $product->path = $fileName;
        }
        $product->name = $request->input('name');
        $product->unsigned_name = changeTitle($request->input('name'));
        $product->category_id = intval($request->input('category'));
        $product->description = $request->input('description');
        $product->price = intval($request->input('price'));
        $product->promotion = intval($request->input('promotion'));
        $product->expiry_date = intval($request->input("expiry_date"));
        $product->weight = intval($request->input("weight"));
        $product->origin = intval($request->input("origin"));
        $product->save();
        return redirect()->route("productList");
    }
    public function create()
    {
        $arrCategory = Category::all();
        return view('admin.pages.product-adding', ["arrCategory" => $arrCategory]);
    }
    public function store(Request $request)
    {
    	$this->validate($request,
            [
                'name'=>'unique:product,name',
            ],
            [
                'name.unique'=>'Tên sản phẩm đã tồn tại',
            ]

        );
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        while(file_exists("images/".$fileName)){
            $fileName = date("YmdHis").$fileName;
        }
        $file->move("images",$fileName);
        $product = new Product;
        $product->name = $request->input('name');
        $product->unsigned_name = changeTitle($request->input('name'));
        $product->category_id = intval($request->input('category'));
        $product->description = $request->input('description');
        $product->price = intval($request->input('price'));
        $product->promotion = intval($request->input('promotion'));
        $product->expiry_date = intval($request->input("expiry_date"));
        $product->weight = intval($request->input("weight"));
        $product->origin = intval($request->input("origin"));
        $product->path = $fileName;
        $product->save();
        return redirect()->route("productList");
    }
    public function updateStatus(Request $request)
    {
        $product = Product::findOrFail(intval($request->input("id")));
        if($product->status == 1)
        {
            $product->status = 0;
        }
        else{
            $product->status = 1;
        }
        $product->save();
        return response()->json(['status'=>$product->status]);
    }
}