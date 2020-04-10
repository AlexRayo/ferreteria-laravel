@extends('layouts.app')
@section('title')
Productos
@endsection
@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

   <h2 align="center">Productos disponibles</h2>
  
   
   <div class="panel panel-default">   
    <div class="panel-body" style="border: none !important">
      <form action="{{route('productos.index')}}" method="GET" class="form-group col-md-12">
         <div class="col-md-5" style="margin: 0 -12px">
               <input name="busqueda" width="300px" class="form-control" placeholder="Búscar por precio, descripción, cantidad o marca" />
         </div>        
         <div class="col-md-2" style="margin: 0 -12px">
            <button type="submit" class="btn btn-default">Búscar <span class="fa fa-search"></span></button>
         </div>
         
         <div class="col-md-5 pull-right" style="margin: 0 -12px"><a href="#ventana" data-toggle="modal" class="btn btn-primary pull-right">Nuevo producto &nbsp;<span class="fa fa-file"></span></a></div>            
     
      </form>

     <div class="table-responsive col-md-12">      
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th width="100px">Disponible</th>
         <th>Descripción</th>
         <th width="100px">Precio compra</th>
         <th width="100px">Precio venta</th>
         <th width="75px">% de utilidad</th>
         <th width="150px">Marca</th>
         <th width="120px">Fecha de compra</th>
         <th width="100px">Editar</th>
        </tr>
       </thead>
       <tbody>
            @foreach ($productos as $producto)
            <tr class="main">
              <td>{{$producto->cantidad_actual}}</td>
              <td>{{$producto->descripcion}}</td>
              <td>{{$producto->precio_compra}}&nbsp;€</td>
              <td>{{$producto->precio_venta}}&nbsp;€</td>
              <td>{{$producto->porcentaje_utilidad}}&nbsp;%</td>
              <td>{{$producto->marca}}</td>
              <td>{{\Carbon\Carbon::parse($producto->fecha_compra)->format('d/m/Y')}}</td>    
              <td><a href="/productos/{{$producto->id}}/edit" class="fa fa-pencil btn btn-primary" title="Ver/Editar"></a>
               <a href="/ventas/{{$producto->id}}/create" class="fa fa-external-link btn btn-success" title="Nueva venta"></a>
              </td>
             </tr>
            @endforeach  
       </tbody>

      </table>
      <!--<h4 align="center">Total de registros : <b><span id="total_records"></b></span></h4>-->
     </div>
    </div>    
   </div>


<!-- NUEVO PRODUCTO -->   
<div class="modal fade" id="ventana">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Agregar un nuevo producto</h4>
         </div>
         <div class="modal-body col-md-12 thumbnail">            
            <form class="" action="{{route('productos.store')}}" method="POST" enctype="multipart/form-data">
                  
               <div class="col-md-12">
                  <div class="col-md-4">
                     <label>Cantidad</label>
                     <input type="number" id="cantidad" name="cantidad" class="form-control" required><br>
                  </div>
                  <div class="col-md-8">
                     <label>Descripción</label>
                     <input name="descripcion" class="form-control" required><br>
                  </div>
               </div>
      
               <div class="col-md-12">
                  <div class="col-md-4">
                     <label>Precio unitario</label>
                     <input id="precio_compra" name="precio_compra" class="form-control" onkeyup="calcularPV()" required><br>
                  </div>
                  <div class="col-md-4">
                        <label>% De utilidad</label>
                        <input type="number" id="ganancia" value="20" class="form-control" id="" min="20" max="500" onkeyup="calcularPV()" required><br>       
                     </div>
                  <div class="col-md-4">
                     <label>Precio de venta</label>&nbsp;&nbsp;<span class="fa fa-info-circle" title="Precio de venta incluye 21% de IVA" style="font-size:20px"></span>
                     <input name="precio_venta" class="form-control" id="precio_venta" required readonly><br>       
                  </div>
               </div>
      
               <div class="col-md-12">
                  <div class="col-md-4">
                     <label>Marca</label>
                     <input value="Sin especificar" name="marca" class="form-control" placeholder="Marca" required><br>
                  </div>
                  <div class="col-md-4">
                     <label>Modelo</label>
                     <input value="Sin especificar" name="modelo" class="form-control" placeholder="Modelo" required><br>
                  </div>
               </div>
      
               <div class="col-md-12">
                  <div class="col-md-8">     
                     <label>Fecha de ingreso</label>
                     <input type="date" name="fecha_compra" class="form-control input-md" required value=<?php echo '"' . date('Y-m-d') . '"';?>/>
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
      </div>
   </div>
</div>

<test-form></test-form>
<test-component-container></test-component-container>

<my-thoughts-components></my-thoughts-components>
<script>
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