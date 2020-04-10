@extends('layouts.app')
@section('title')
Editar venta
@endsection
@section('content')
    
<div class="col-md-5 text-center">
    <h1>Editar venta</h1>
    <h3>Producto: <b>{{$venta->producto->descripcion}}</b></h3>
</div>        
<div class="col-md-6 thumbnail box-shadow"> 
    @if (!Auth::guest())               
        @if (Auth::user()->name == "Admin")        
        <p onclick="showValidationWindow()" class="fa fa-trash  btn btn-danger pull-right" id="delBtn" title="Borrar el registro"></p>
                    
        <div id="validationWindow" style="display: none;" class="col-lg-12 thumbnail pull-right">        
            <h4 style="color:crimson"><b>Se eliminará todo el registro</b></h4 style="color:crimson">
            <div>
                <p id="hideValWin" onclick="hideValidationWindow()"class="okBtn DefBtn btn btn-primary pull-right">Cancelar</p>
                <form action="{{route('ventas.destroy', $venta->id)}}" method="POST" enctype="multipart/form-data">
                    
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-default" value="Eliminar">
                {{ csrf_field()}}
                </form>
            </div>
        </div><br><br> 
        @endif
    @endif             
   <form action="{{route('ventas.update', $venta->id)}}" method="POST" enctype="multipart/form-data">
 
        <h4><b>{{$venta->cantidad}} {{$venta->producto->descripcion}}</b> vendidxs</h4>
        <h4 style="border-bottom: dotted 2px #ccc;padding-bottom:10px"><b>{{$venta->producto->precio_venta}} €</b> c/u</h4>
        <input type="hidden" value="{{$venta->id}}" name="id_producto">
        
        <label>Cantidad de venta</label>
        <input type="number" value="{{$venta->cantidad}}" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" required max="{{$venta->cantidad_actual}}" onkeyup="totalCancelar()"><br>

        <label>Descuento</label>
        <input type="number" value="{{$venta->descuento}}" name="descuento" id="descuento" value="0.00" class="form-control" placeholder="Nombre del solicitante" required onkeyup="totalCancelar()" min="0"><br>
       
        <input type="hidden" value="{{$venta->producto->precio_venta}}" id="precio_unitario" class="form-control" readonly>

        <label>Total a cancelar</label>
        <input id="total" value="{{$venta->total}}" name="total" class="form-control" readonly required>

        <label>Cliente</label>
        <input name="cliente" value="{{$venta->cliente}}" class="form-control" placeholder="Nombre del solicitante" required><br>
        
        <input name="producto" type="hidden" value="{{$venta->producto->descripcion}}" class="form-control" required readonly>

        <label class="col-md-6 control-label" for="fecha_inicio">Fecha de venta</label>
        <div class="col-md-5">
            <input type="date" name="fecha_venta" class="form-control input-md" required value="{{$venta->fecha_venta}}"/>
        </div><br><br>             

        <label>Notas</label>

        <textarea name="notas" class="form-control" placeholder="Notas" required>{{$venta->notas}}</textarea><br>
        
        <button class="btn btn-primary"><span class="fa fa-save"></span>&nbsp; Guardar</button>
        
        {{ csrf_field()}}

    </form>
</div>

<style>select{height: 40px !important;}</style>
<script>
	function showValidationWindow() {
		var validationWindow = document.getElementById("validationWindow");
		validationWindow.style.display = "block";
		var delBtn = document.getElementById("delBtn");
		delBtn.style.display = "none";
	}
	function hideValidationWindow() {
		var validationWindow = document.getElementById("validationWindow");
		validationWindow.style.display = "none";
		var delBtn = document.getElementById("delBtn");
		delBtn.style.display = "block";
	}

    function totalCancelar(){
    var cantidad = eval(document.getElementById("cantidad").value);
    var precioUnitario = eval(document.getElementById("precio_unitario").value);
    var descuento = eval(document.getElementById("descuento").value);

    var total = (cantidad * precioUnitario) - descuento;
    document.getElementById('total').value = parseFloat(Math.round(total * 100) / 100).toFixed(2);

}
calcularPV();
   function calcularPV(){
       var precioCompra = eval(document.getElementById("precio_compra").value);
       var ganancia = eval(document.getElementById("ganancia").value);

       var gananciaNeta = (ganancia/100) * precioCompra;
       var iva = precioCompra * 0.21;  
       var precioVenta = precioCompra + iva + gananciaNeta;

       document.getElementById('precio_venta').value = parseFloat(Math.round(precioVenta * 100) / 100).toFixed(2);

   }   
</script>
@endsection