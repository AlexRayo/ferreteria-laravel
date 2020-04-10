<?php

namespace App\Http\Controllers;

use App\Venta;
use App\Producto;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::orderBy('updated_at','desc');
        $ventas = Venta::orderBy('updated_at','desc');

        return view('home', compact(['productos', 'ventas']));
    }
}
