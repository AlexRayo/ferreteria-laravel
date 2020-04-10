
@extends('layouts.app')
@section('title')
Ventas
@endsection
@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<h2 align="center">Registro de ventas</h2><br />

   <div class="panel panel-default">
    <!--<div class="panel-heading">Realizar una búsqueda</div>-->
    <div class="panel-body">

      <form action="{{route('ventas.index')}}" method="GET" class="form-group col-md-12">
        <div class="col-md-5" style="margin: 0 -12px">
            <input name="busqueda" width="300px" class="form-control" placeholder="Búscar por precio, descripción, cantidad o marca" />
        </div>        
       <div class="col-md-7 pull-right" style="margin: 0 -12px">
          <button type="submit" class="btn btn-primary">Búscar <span class="fa fa-search"></span></button>
       </div>
        
      </form>

     <div class="table-responsive col-md-12">      
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th width="50px">Cant.</th>
         <th>Descripcion</th>
         <th width="100px">Precio und.</th>
         <th width="100px">Descuento</th>
         <th width="100px">Total</th>
         <th width="120px">Fecha de venta</th>
         <th width="100px">Utilidad</th>
         <th width="50px">Editar</th>
        </tr>        
       </thead>
       
       <tbody>
        @foreach ($ventas as $venta)
        <tr class="main">
          <td>{{$venta->cantidad}}</td>
          <td>{{$venta->producto->descripcion}}</td>
          <td>{{$venta->producto->precio_venta}}&nbsp;€</td>
          <td>{{$venta->descuento}}&nbsp;€</td>
          <td>{{$venta->total}}&nbsp;€</td>
          <td>{{\Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y')}}</td>
          <td>{{$venta->utilidad}}&nbsp;€</td>    
          <td><a href="/ventas/{{$venta->id}}/edit" class="fa fa-pencil btn btn-primary" title="Ver/Editar"></a>
          </td>
         </tr>
        @endforeach            
       </tbody>
         
      </table>
      {{$ventas->links()}}
   
   </div>
    </div>    
   </div>

@endsection