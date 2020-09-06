<?php

namespace App\Http\Controllers;

use App\Item;
use App\Brand;
use App\Subcategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $items=Item::all();//use item model
        //dd($items);
        return view('Backend.Items.index',compact('items')) ;   //compactကdata သွားဆွဲထုတ်တာ
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands=Brand::all();
        $subcategories=Subcategory::all();
        return view('Backend.Items.create',compact('brands','subcategories'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request)
        //insert database

        //validation စစ်တာ
            $request->validate([
                "codeno"=>'required|min:4',
                "name"=>'required',

                "price"=>'required',
                "discount"=>'required',
                "description"=>'required',
                "photo"=>'required|mimes:jpg,jpeg,png',
                "brand"=>'required',
                "subcategory"=>'required'
            ]);

        // if include file,upload file
            $imageName=time().'.'.$request->photo->extension();

            $request->photo->move(public_path('backend/itemimg'),$imageName);//file upload

            $path= 'backend/itemimg/'.$imageName;
        //datainsert
          $item=new Item;

          $item->codeno=$request->codeno;
          $item->name=$request->name;
         
          $item->photo=$path;

          $item->price=$request->price;
          $item->discount=$request->discount;
          $item->description=$request->description;

         $item->brand_id=$request->brand;
         $item->subcategory_id=$request->subcategory;
         $item->save();

         



        //redirect
         return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('Backend.Items.orderdetail',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //show form with old data
         $brands=Brand::all();
        $subcategories=Subcategory::all();
        return view('Backend.Items.edit',compact('brands','subcategories','item')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //  dd($request)
        
        //  validation
            $request->validate([
                "codeno"=>'required|min:4',
                "name"=>'required',
                "price"=>'required',
                "discount"=>'required',
                "description"=>'required',
                "photo"=>'sometimes|mimes:jpg,jpeg,png',
                "oldphoto"=>'required',
                "brand"=>'required',
                "subcategory"=>'required'
             ]);
        //  upload file
            if($request->hasFile('photo')){

                $imageName=time().'.'.$request->photo->extension();

                $request->photo->move(public_path('backend/itemimg'),$imageName);//file upload

                $path= 'backend/itemimg/'.$imageName;

            }else{
                $path=$request->oldphoto;
            }
        //  data update
            $item->codeno=$request->codeno;
            $item->name=$request->name;
         
            $item->photo=$path;

            $item->price=$request->price;
            $item->discount=$request->discount;
            $item->description=$request->description;

            $item->brand_id=$request->brand;
            $item->subcategory_id=$request->subcategory;
            $item->save();
            
        //  rediret
            return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        
        $item->delete();
        return redirect()->route('items.index');  
    }
}
