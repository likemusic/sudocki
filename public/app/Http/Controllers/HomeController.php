<?php

namespace App\Http\Controllers;

use App\models\Categories;
use Auth;
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

        $isAdmin = auth()->user()->hasRole('admin');
        $isManager = auth()->user()->hasRole('manager');
        //$isUser = auth()->user()->hasRole('user');

        $categories = Categories::with('products')->get();

        if ($isAdmin || $isManager) {
            return view('main-page-admin', ['categories' => $categories, 'isAdmin' => true,]);
        } else {
            return view('main-page-customer', ['categories' => $categories, 'isAdmin' => false,]);
        }
    }
}
