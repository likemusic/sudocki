<?php

namespace App\Http\Controllers\Cabinet;

use App\helpers\ConstantHelper;
use App\Http\Controllers\Controller;
use App\models\Categories;
use App\models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


      //  $categories = Categories::with('products')->get();
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(10);

        return view('cabinet.orders',['orders'=>$orders]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order= (new Order($request))->withUser()->withDetail()->withTotal()->withDiscount();
        $order->saveCustomRelation();
        $message='Ваш заказ поставлен в обработку';
        $status=ConstantHelper::ENTITY_CREATED;
        return  ['status'=>$status,'message'=>$message, 'model'=>$order ];
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
     * Display the specified resource.
     *
     * @param  \App\models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->detail;
        return  $order;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Order  $order
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
     * @param  \App\models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
