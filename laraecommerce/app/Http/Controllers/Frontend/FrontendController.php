<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sliders;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class FrontendController extends Controller
{
    public function searchProducts(Request $request)
    {
        if($request)
        {
            $searchProducts = Product::where('Name','LIKE','%'.$request->search.'%')->latest()->paginate(5);
            return view('frontend.pages.search',compact('searchProducts'));
        }
        else
        {
            return redirect()->back()->with('message','Empty Search');
        }
    }
  
    public function thankyou()
    {
        return view('frontend.thank-you');
    }
    public function index()
    {

        $sliders = Sliders::where('status','0')->get();
        $trendingProducts = Product::where('trending','1')->latest()->take(15)->get();
        return view('frontend.index', compact('sliders','trendingProducts'));
    }

    public function categories()
    {
        $categories = Category::where('status','1')->get();
        return view('frontend.collections.category.index', compact('categories'));
        
    }
    public function products($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        
        if($category)
        {
           return view('frontend.collections.products.index',compact('category'));
        }else{
            return redirect()->back();
        }
    }

    
    public function productView(string $category_slug, string  $product_slug)
    {

        $category = Category::where('slug',$category_slug)->first();
        
        if($category)
        { 
            $product = Product::where('slug',$product_slug )->where('category_id',$category->id)->where('status','0')->first();
            // echo('product'); 
            // print_r($product); die;
            if($product)
            {
                return view('frontend.collections.products.view',compact('product','category'));
            }else{
                return redirect()->back();
            }
          
        }else{
            return redirect()->back();
        }
    }

    public function newArrivals()
    {
        $newArrivalsProducts = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arrival', compact('newArrivalsProducts'));
    }


    public function electronics()
    {
        $electronics = Product::where('electronics','1')->latest()->get();
        return view('frontend.pages.electronics', compact('electronics'));
    }

    public function stationaryProducts()
    {
        $stationaryproducts = Product::where('Stationary','1')->latest()->get();
        return view('frontend.pages.stationary', compact('stationaryproducts'));
    }

    public function accessories()
    {
        $accessories = Product::where('accessories','1')->latest()->get();
        return view('frontend.pages.accessories', compact('accessories'));
    }

    public function homeDecoration()
    { 
        $homedecor = Product::where('homedecore','1')->latest()->get();
        return view('frontend.pages.homedecoration',compact('homedecor'));
    }
}
