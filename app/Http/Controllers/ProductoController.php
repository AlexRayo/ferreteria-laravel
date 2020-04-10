<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use DB;

class ProductoController extends Controller
{
    /* Autenticación para ingresar al sistema */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->get('busqueda');
        $productos = Producto::where('precio_venta', 'like', '%'.$query.'%')
         ->orWhere('descripcion', 'like', '%'.$query.'%')
         ->orWhere('cantidad_actual', 'like', '%'.$query.'%')
         ->orWhere('marca', 'like', '%'.$query.'%')
         ->paginate(10);    
        
        return view('productos.index', compact(['productos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    Producto::create($request->all());

        return redirect('/productos')->with('success', 'Nuevo agregado: '.$producto->descripcion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('productos.edit', compact(['producto']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);        
        #$producto->cantidad_inicial= $request->input('cantidad');
        $producto->cantidad_actual= $request->input('cantidad');
        $producto->descripcion= $request->input('descripcion');        
        $producto->precio_compra= $request->input('precio_compra');
        $producto->porcentaje_utilidad= $request->input('porcentaje_utilidad');
        $producto->precio_venta= $request->input('precio_venta');
        $producto->fecha_compra= $request->input('fecha_compra');
        $producto->marca= $request->input('marca');
        $producto->modelo= $request->input('modelo');
        $producto->notas= $request->input('notas');
        $producto->save();

        return redirect('/productos')->with('success', 'Se ha actualizado: '.$producto->descripcion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);

        $producto->delete();
        return redirect('/productos')->with('success', 'Se ha eliminado: '.$producto->descripcion);
    }
}
