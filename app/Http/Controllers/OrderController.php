<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data1=DB::table('order')->join('order_item','order.id','=','order_item.order_id')->orderby('order.created_at','DESC')->paginate(5);
        // dd($data1);
        // $data = Order::orderby('created_at','DESC')->orderby('id','ASC')->paginate(5);
        // dd($data);
        if ($key=request()->key){
            // $data = Order::where('id', 'like', '%'.$key.'%')->orderby('created_at','DESC')->paginate(5);
            $data = DB::table('order')->join('order_item','order.id','=','order_item.order_id')->where('order_item.order_id', 'like', '%'.$key.'%')->orderby('order_item.created_at','DESC')->paginate(10);
        }
        else {
            // $data = Order::orderby('created_at','DESC')->orderby('id','ASC')->paginate(5);
            $data = DB::table('order')->join('order_item','order.id','=','order_item.order_id')->orderby('order_item.created_at','DESC')->orderby('order_item.order_id','ASC')->paginate(10);
        }
        return view('admin.order.index',['data'=>$data]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        // $order_item = $order->join('order_item','order.id','=','order_item.order_id');
        // dd($order_item->find($order->id));
        return redirect()->route('admin.order.index')->with('success', 'Xóa bản ghi thành công');
    }
}
