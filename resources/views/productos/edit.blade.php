@extends('layouts.app')
@section('title')
Editar producto
@endsection
@section('content')
    
<div class="col-md-5 text-center">
    <h1>Editar compra</h1>
    <h3>Herramienta: <b>{{$producto->descripcion}}</b></h3>
</div>        
<div class="col-md-6 thumbnail box-shadow"> 
    @if (!Auth::guest())               
        @if (Auth::user()->name == "Admin")        
        <p onclick="showValidationWindow()" class="fa fa-trash  btn btn-danger pull-right" id="delBtn" title="Borrar el registro"></p>
                    
        <div id="validationWindow" style="display: none;" class="col-lg-12 thumbnail pull-right">        
            <h4 style="color:crimson"><b>Se eliminará todo el registro</b></h4 style="color:crimson">
            <div>
                <p id="hideValWin" onclick="hideValidationWindow()"class="okBtn DefBtn btn btn-primary pull-right">Cancelar</p>
                <form action="{{route('productos.destroy', $producto->id)}}" method="POST" enctype="multipart/form-data">
                    
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-default" value="Eliminar">
                {{ csrf_field()}}
                </form>
            </div>
        </div><br><br> 
        @endif
    @endif             
    <form action="{{route('producto.update', $producto->id)}}" method="POST" enctype="multipart/form-data">
                  
      <div class="col-md-12">
         <div class="col-md-4">
            <label>Cantidad</label>
         <input type="number" value="{{$producto->cantidad_actual}}" id="cantidad" name="cantidad" class="form-control" onkeyup="calcularPV()" required><br>
         </div>
         <div class="col-md-8">
            <label>Descripción</label>
            <input name="descripcion" value="{{$producto->descripcion}}" class="form-control" required><br>
         </div>
      </div>

      <div class="col-md-12">
         <div class="col-md-4">
            <label>Precio unitario</label>
            <input id="precio_compra" name="precio_compra" value="{{$producto->precio_compra}}" class="form-control" onkeyup="calcularPV()" required><br>
         </div>
         <div class="col-md-4">
               <label>% De utilidad</label>
               <input type="number" id="ganancia" value="{{$producto->porcentaje_utilidad}}" name="porcentaje_utilidad" class="form-control" id="" min="20" max="500" onkeyup="calcularPV()" required><br>       
            </div>
         <div class="col-md-4">
            <label>Precio de venta</label>&nbsp;&nbsp;<span class="fa fa-info-circle" title="Precio de venta incluye 21% de IVA" style="font-size:20px"></span>
            <input name="precio_venta" value="{{$producto->precio_venta}}" class="form-control" id="precio_venta" required readonly><br>       
         </div>
      </div>

      <div class="col-md-12">
         <div class="col-md-4">
            <label>Marca</label>
            <input value="Sin especificar" name="marca" value="{{$producto->marca}}" class="form-control" placeholder="Marca" required><br>
         </div>
         <div class="col-md-4">
            <label>Modelo</label>
            <input value="Sin especificar" name="modelo" value="{{$producto->modelo}}" class="form-control" placeholder="Modelo" required><br>
         </div>
      </div>

      <div class="col-md-12">
         <div class="col-md-8">     
            <label>Fecha de ingreso</label>
            <input type="date" name="fecha_compra" value="{{$producto->fecha_compra}}" class="form-control input-md" required/>
         </div>
      </div>

      <div class="col-md-12">
         <div class="col-md-8"><br>     
            <label>Notas</label>
            <textarea name="notas" class="form-control" cols="30" rows="2" placeholder="Notas" required>Ninguna</textarea>
         </div>
      </div>

      <div class="col-md-12">
         <div class="col-md-12"><br>   
            <button class="btn btn-primary"><span class="fa fa-save"></span>&nbsp; Guardar</button>
         </div>
      </div>
      <div>
         
      </div>
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