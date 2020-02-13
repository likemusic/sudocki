<?php

namespace App\Http\Controllers;

use App\models\Categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $invoices=Invoice::with('detail','expencies')->where('upload_type','=',InvoiceDetail::UPLOAD_TYPE_WAY_BILL)->orderBy('id','desc')->paginate(10);
        $categories = Categories::with('products')->get();
        return view('main-page-customer',['categories'=>$categories]);
    }
}
