<?php

namespace App\Http\Controllers;

use App\Venta;
use App\Producto;
use Illuminate\Http\Request;
use DB;

class VentaController extends Controller
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
        $ventas = Venta::orderBy('updated_at','desc')
          ->join('productos', 'productos.id','=','ventas.id_producto')
         ->select('ventas.*','productos.descripcion')->where('ventas.cantidad', 'like', '%'.$query.'%')
         ->orWhere('ventas.cliente', 'like', '%'.$query.'%')
         ->orWhere('productos.descripcion', 'like', '%'.$query.'%')
         ->orWhere('productos.precio_venta', 'like', '%'.$query.'%')
         ->orWhere('productos.marca', 'like', '%'.$query.'%')
         ->paginate(10);    
        
        return view('ventas.index', compact(['ventas']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $productos = Producto::find($id);
        return view('ventas.create', compact(['productos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venta = new Venta;        
        $cantidad =  $request->input('cantidad');

        
        $venta->id_producto= $request->input('id_producto');
        $venta->cantidad = $cantidad;
        $venta->total= $request->input('total');
        $venta->utilidad = 0.00;
        $venta->cliente= $request->input('cliente');
        $venta->fecha_venta= $request->input('fecha_venta');
        $venta->descuento= $request->input('descuento');
        $venta->notas= $request->input('notas');
        $venta->save();

        #una vez creada la venta (que ya exista) se actualiza la utilidad(tabla ventas) y cantidad de productos (tabla productos)
        
        $utilidadUnd = ($venta->producto->precio_venta) - ($venta->producto->precio_compra);
        $utilidad = ($cantidad * $utilidadUnd) - $venta->descuento;       
        
        $disponible = $venta->producto->cantidad_actual;
        $cantVenta = $request->input('cantidad');
        $new = $disponible - $cantVenta;

        DB::table('ventas')
        ->where("ventas.id", '=',  $venta->id)
        ->update(['ventas.utilidad'=> "$utilidad"]);

        DB::table('productos')
        ->where("productos.id", '=',  $venta->producto->id)
        ->update(['productos.cantidad_actual'=> "$new"]);

        return redirect('/ventas')->with('success', 'Nueva venta registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Venta::find($id);
        return view('ventas.edit', compact(['venta']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $venta = Venta::find($id);

        $disponible = $venta->producto->cantidad_actual;        
        $cantAnterior = $venta->cantidad;
        $newDisponible = $disponible + $cantAnterior; #en este punto es como si se hubiese eliminado la venta
        $cantidad = $request->input('cantidad');

        $venta->cantidad = $cantidad;
        $venta->total= $request->input('total');
        $venta->cliente= $request->input('cliente');
        $venta->fecha_venta= $request->input('fecha_venta');
        $venta->descuento= $request->input('descuento');
        $venta->notas= $request->input('notas');
        $venta->save();
        #una vez creada la venta se actualiza la cantidad de productos
        $utilidadUnd = ($venta->producto->precio_venta) - ($venta->producto->precio_compra);
        $utilidad = ($cantidad * $utilidadUnd) - $venta->descuento;  

        $cantVenta = $venta->cantidad;
        $new = $newDisponible - $cantVenta;

        DB::table('ventas')
        ->where("ventas.id", '=',  $venta->id)
        ->update(['ventas.utilidad'=> "$utilidad"]);

        DB::table('productos')
        ->where("productos.id", '=',  $venta->producto->id)
        ->update(['productos.cantidad_actual'=> "$new"]);

        return redirect('/ventas')->with('success', 'Venta actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta = Venta::find($id);

        $disponible = $venta->producto->cantidad_actual;
        $cantventa = $venta->cantidad;
        $new = $disponible + $cantventa;

        DB::table('productos')
        ->where("productos.id", '=',  $venta->id_producto)
        ->update(['productos.cantidad_actual'=> "$new"]);

        $venta->delete();
        return redirect('/ventas')->with('success', 'Registro eliminado');
    }
}
