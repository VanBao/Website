<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\BillDetail;
use App\Category;
use Cart;
use Session;
use App\Customer;
use App\Bill;
use Auth;
use App\Contact;
class PageController extends Controller
{
	public function showHome()
	{
		$arrSlides = Slide::where('status', 1)->get();
		$arrPromotions = Product::where("promotion", "<>", 0)->paginate(6,['*'],'page1');
		$arrFeaturedProducts = Product::whereRaw("round((vote * 1.0) / view, 0) >= 2.6")->orderBy("view", "desc")->paginate(6,['*'],'page2');
		$arrBestSeller = BillDetail::select("unsigned_name", "product_id", "name", 'price', 'promotion','path')->join("product", "bill_detail.product_id", "product.id")->groupBy('unsigned_name','price', 'name', 'product_id', 'promotion', 'path')->havingRaw('sum(quantity) >= 10')->paginate(6,['*'],'page3');
		return view("pages.home",['slides' => $arrSlides, "promotions" => $arrPromotions, 'featuredProducts' => $arrFeaturedProducts, "bestSellers" => $arrBestSeller]);
	}
	public function loadDataHome($type, $page)
	{
		$products = null;
		if ($type == 1)
		{
			$products = Product::where("promotion", "<>", 0)->offset($page * 6 - 6)->limit(6)->get();
			
		}
		elseif($type = 2)
		{
			$products = Product::whereRaw("round((vote * 1.0) / view, 0) >= 2.6")->orderBy("view", "desc")->offset($page * 6 - 6)->limit(6)->get();
		}
		else
		{
			$products = BillDetail::select("unsigned_name", "product_id", "name", 'price', 'promotion','path')->join("product", "bill_detail.product_id", "product.id")->groupBy('unsigned_name','price', 'name', 'product_id', 'promotion', 'path')->havingRaw('sum(quantity) >= 10')->limit(6)->get();
		}
		return view("ajax.home", ["products"=>$products]);
	}
	public function showAdminHome()
	{
		$contactNum = count(Contact::where('status', 0)->get());
		$billNum = count(Bill::where('status', 0)->get());
		return view("admin.pages.home", ['contactNum'=>$contactNum, 'billNum'=>$billNum]);
	}
	public function showContact()
	{
		return view("pages.contact");
	}
	public function showCart()
	{
		if(!Session::exists("cart"))
        {
            session(["cart" => new Cart]);
        }
		$cart = session("cart")->getCart();
		$arrProduct = session("cart")->getProductsInCart();
		return view("pages.cart", ['cart'=>$cart, 'products'=>$arrProduct]);
	}
	public function showAbout()
	{
		return view("pages.about");
	}
	public function showLogin()
	{
		return view("pages.login");
	}
	public function showChangeInformation()
	{
		return view("pages.change-information");
	}
	public function showChangePassword()
	{
		return view("pages.change-password");
	}
	public function showResetPassword()
	{
		return view("pages.reset-password");
	}
	public function showRegister()
	{
		return view("pages.register");
	}
	public function showProductDetail($name)
	{
		$product = Product::where('unsigned_name', $name)->first();
		$product->view = $product->view + 1;
		$product->save();
		$arrRelatedProducts = Product::where('category_id', $product->category_id)->take(4)->get();
		return view("pages.detail", ['product' => $product, 'relatedProducts' => $arrRelatedProducts]);
	}
	public function showCategory($name, $page = 1)
	{
		$category = Category::where('unsigned_name', $name)->first();
		$page = intval($page);
		if($page != 1)
		{
			$products = $category->Product()->offset($page * 6 - 6)->limit(6)->get();
			return view("ajax.search", ["products"=>$products]);
		}
		$products = $category->Product();
		$total = $products->count() / 6;
		if($total - floor($total) != 0)
		{
			$total = floor($total) + 1;
		}
		else
		{
			$total = floor($total);
		}
		$products = $products->offset(0)->limit(6)->get();
		return view("pages.category", ["products" => $products, "categoryName" => $category->name,"total"=>$total, "unsigned_name"=>$name]);
	}
	public function purchase($id, $quantity)
	{
		session("cart")->add(intval($id), intval($quantity));
		return redirect()->route("cart");
	}
	public function deleteProductInCart($id)
	{
		session("cart")->delete($id);
		return redirect()->route("cart");
	}
	public function updateCart($id, $quantity)
	{
		session("cart")->update($id, $quantity);
		return redirect()->route("cart");
	}
	public function order(Request $request)
	{
		$customer = new Customer;
		$bill = new Bill;
		if(Auth::check())
		{
			$customer = Customer::where([["email", Auth::user()->email],["isMember", 1]])->first();
			if(is_null($customer))
			{
				$user = Auth::user();
     			$customer->name = $user->name;
     			$customer->email = $user->email;
     			$customer->address = $user->address;
     			$customer->phone_number = $user->phone_number;
     			$customer->isMember = 1;
     			$customer->save();	
     			$bill->customer_id = Customer::max("id");
			}
			else
			{
				$bill->customer_id = $customer->id;
			}
			
		}
		else
		{
			$this->validate
			(
				$request, 
				[
            		'phonenumber'=>'digits_between:10,11'
            	], 
            	[        
            		'phonenumber.digits_between'=>'Số điện thoại không hợp lệ'
         		]
     		);
     		$customer->name = $request->input("name");
     		$customer->email = $request->input("email");
     		$customer->address = $request->input("address");
     		$customer->phone_number = $request->input("phonenumber");
     		$customer->save();
     		$bill->customer_id = Customer::max("id");
		}
     	$bill->note = $request->input("message");
     	$bill->total = session("cart")->cost();
     	$bill->save();
     	foreach (session("cart")->getCart() as $key =>$value) 
     	{
     		$bill_detail = new BillDetail;
     		$bill_detail->bill_id = Bill::max("id");
     		$bill_detail->product_id = $key;
     		$bill_detail->quantity = $value;
     		$bill_detail->save();
     	}
     	Session::forget("cart");
     	Session::flash("messageSuccessful", "Bạn đã đặt hàng thành công.");
     	return redirect()->route("cart");
    }
	public function showAccount()
	{
		$customer = Customer::where([["email", Auth::user()->email],["isMember", 1]])->first();
		return view("pages.account", ["bills"=>$customer->Bill()->paginate(6)]);
	}
	public function search(Request $request, $page = 1)
	{
		$keyword = $request->input("keyword");
		$currentPage = intval($page);
		if($currentPage != 1)
		{
			$products = Product::whereRaw("MATCH (name) AGAINST ('$keyword' IN BOOLEAN MODE)")->offset($currentPage * 6 - 6)->limit(6)->get();
			return view("ajax.search", ["products"=>$products]);
		}
		$products = Product::whereRaw("MATCH (name) AGAINST ('$keyword' IN BOOLEAN MODE)");
		$total = $products->count() / 6;
		if(($total - floor($total)) != 0)
		{
			$total = floor($products->count() / 6) + 1;
		}
		else
		{
			$total = floor($products->count() / 6);
		}
		$products = $products->offset(0)->limit(6)->get();
		return view("pages.search", ["products"=>$products, "keyword"=>$keyword, "total"=>$total]);
	}
	public function updateVote(Request $request)
	{
		$id = intval($request->input("id"));
		$vote = intval($request->input("vote"));
		$product = Product::findOrFail($id);
		$product->vote = $product->vote + $vote;
		$product->save();
		$data = ["id"=>$id, "rate"=> round($product->vote / $product->view)];
		return response()->json($data);
	}
	public function show404NotFound()
	{
		return view("404");
	}
}
