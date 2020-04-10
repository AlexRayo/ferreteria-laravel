@extends('layouts.app')
@section('title')
Nueva venta
@endsection
@section('content')
    
<div class="col-md-5 text-center">
<h1>Nueva venta</h1>
</div>        
<div class="col-md-6 thumbnail box-shadow">            
    <form action="{{route('ventas.store')}}" method="POST" enctype="multipart/form-data">
        @if ($productos->cantidad_actual > 0)
        <h4><b>{{$productos->cantidad_actual}} {{$productos->descripcion}}</b> Disponibles</h4>
        <h4 style="border-bottom: dotted 2px #ccc;padding-bottom:10px"><b>{{$productos->precio_venta}} €</b> c/u</h4>
        <input type="hidden" value="{{$productos->id}}" name="id_producto">
        
        <label>Cantidad de venta</label>
        <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" required max="{{$productos->cantidad_actual}}" onkeyup="totalCancelar()"><br>

        <label>Descuento</label>
        <input type="number" name="descuento" id="descuento" value="0.00" class="form-control" placeholder="Nombre del solicitante" required onkeyup="totalCancelar()" min="0"><br>
       
        <input type="hidden" value="{{$productos->precio_venta}}" id="precio_unitario" class="form-control" readonly>

        <label>Total a cancelar</label>
        <input id="total" name="total" class="form-control" readonly required>

        <label>Cliente</label>
        <input name="cliente" value="Sin especificar" class="form-control" placeholder="Nombre del solicitante" required><br>
        
        <input name="producto" type="hidden" value="{{$productos->descripcion}}" class="form-control" required readonly>

        <label class="col-md-6 control-label" for="fecha_inicio">Fecha de venta</label>
        <div class="col-md-5">
            <input type="date" name="fecha_venta" class="form-control input-md" required value=<?php echo '"' . date('Y-m-d') . '"';?>/>
        </div><br><br>             

        <label>Notas</label>
        <input type="text" value="Ninguna" name="notas" class="form-control" placeholder="Notas" id="phone" required><br>
        
        <button class="btn btn-primary"><span class="fa fa-save"></span>&nbsp; Guardar</button>
        @else <h3>No hay {{$productos->descripcion}} disponibles</h3>
        @endif        
        {{ csrf_field()}}

    </form>
</div>

<style>select{height: 40px !important;}</style>
<script>
function totalCancelar(){
    var cantidad = eval(document.getElementById("cantidad").value);
    var precioUnitario = eval(document.getElementById("precio_unitario").value);
    var descuento = eval(document.getElementById("descuento").value);

    var total = (cantidad * precioUnitario) - descuento;
    document.getElementById('total').value = parseFloat(Math.round(total * 100) / 100).toFixed(2);

}
</script>
@endsection