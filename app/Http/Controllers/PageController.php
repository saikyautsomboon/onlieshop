<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
Use App\Item;
Use App\Brand;
Use App\Category;
Use App\Subcategory;

class PageController extends Controller
{
    function mainfun($value='')
    {
        // dd('hi');
        // item model
        $items = Item::take(5)->orderBy('id','DESC')->get();
        $brands=Brand::all();
        $categories=Category::all();
        //dd($items);
    	// $route=Route::current();
    	// dd($route); //လက်ရှိဟာကိုထုတ်ကြည့်တာ dd dieနဲ့တူတယ်
    	return view('main',compact('items','brands','categories'));//view user show place
        //return view('master1',compact('categories'));
    }
    function brandfun($id)
    {   $brands=Brand::find($id);
    	return view('brand',compact('brands'));
    }
    function itemdetailfun($id)
    {
        $item=Item::find($id);
    	return view('itemdetail',compact('item'));
    }
    function lgoinfun($value='')
    {
    	return view('login');//('foldername.filename')
    }
    function promotionfun($value='')
    {
    	return view('promotion');
    }
    function registerfun($value='')
    {
    	return view('register');
    }
    function shoppingcartfun($value='')
    {
    	return view('shoppingcart');
    }
     function subcategoryfun($id)
    {
        $subcategory=Subcategory::find($id);
        $subcategories=Subcategory::all();
        //$categories=Category::all();
    	return view('subcategory',compact('subcategories','subcategory'));
    }
    function orderdetailfun($id)
    {
        $items=Item::find($id);
        return view('Backend.Items.orderdetail',compact('items'));    
    }
}
