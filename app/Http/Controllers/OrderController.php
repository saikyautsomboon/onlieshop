<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Auth;
class OrderController extends Controller
{
    public function __construct($value='')
    {
        $this->middleware('role:Admin')->only('index','show');
        $this->middleware('role:Customer')->only('store');
        # code...
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $orders=Order::all();//use item model
        //dd($items);
        return view('Backend.Orders.index',compact('orders')) ; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catArr = $request->shop_data;
        //  dd($catArr);
        $total =0;
        foreach ($catArr as $row) {
           $total+=($row['price'] * $row['quantity']);
        }
        $order = new Order;
        $order->voucherno = uniqid();
        $order->orderdate = date('Y-m-d');//table col name=value
        $order->user_id=Auth::id();//လက်ရှိlogin user ကိုဆွဲထုတ်တာ
        $order->note = $request->notes;
        $order->total = $total;
        $order->save();
        foreach ($catArr as $row) {
           $order->items()->attach($row['id'],['qty'=>$row['quantity']]);
        }
        return 'Successful';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('Backend.Orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

}
