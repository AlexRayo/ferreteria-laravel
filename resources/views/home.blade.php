@extends('layouts.app')

@section('content')

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    <header id="header">
      <div class="container" style="padding-top: 0 !important">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small></small></h1>
          </div>
          <!--
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Create Content
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a type="button" data-toggle="modal" data-target="#addPage">Add Page</a></li>
                <li><a href="#">Add</a></li>
                <li><a href="#">Add</a></li>
              </ul>
            </div>
          </div>
        </div>
        -->
      </div>
    </header>
<!--
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>
-->
    <section id="main">
      <div class="">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="/home" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="/productos" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Productos registrados <span class="badge">{{$productos->count()}}</span></a>
              <a href="/ventas" class="list-group-item"><span class="fa fa-external-link" aria-hidden="true"></span> Ventas registradas <span class="badge">{{$ventas->count()}}</span></a>
            </div>
        <!--  
            <div class="well">
              <h4>Disk Space Used</h4>
              <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                      60%
              </div>
            </div>
            <h4>Bandwidth Used </h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
            </div>
          </div>
            </div>
                    -->
          </div>

          <div class="col-md-9">
            <!-- Website Overview -->
            
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Visión general</h3>
              </div>

              <div class="panel-body">
                <a href="/productos" class="col-md-6" style="text-decoration: none">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> {{$productos->count()}}</h2>
                    <h4>Productos</h4>
                  </div>
                </a>

                <a href="/ventas" class="col-md-6" style="text-decoration: none">
                  <div class="well dash-box">
                    <h2><span class="fa fa-external-link" aria-hidden="true"></span> {{$ventas->count()}}</h2>
                    <h4>Ventas</h4>
                  </div>    
                </a>

            <!-- Latest Products -->
            <div class="panel panel-default col-md-12">
            <div class="panel-heading">
                <h3 class="panel-title"><b>Ultimos productos agregados</b></h3>
            </div>
                <div class="panel-body">
                <table class="table table-striped table-hover">                      
                    <tr>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                    @foreach($productos->take(3)->get() as $producto)              
                    <tr>
                        <td>{{$producto->cantidad_actual}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td>{{ \Carbon\Carbon::parse($producto->fecha_compra)->format('d/m/Y')}}</td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>

            <!-- Latest Sales -->
            <div class="panel panel-default col-md-12">
                <div class="panel-heading">
                    <h3 class="panel-title"><b>Ultimas ventas</b></h3>
                </div>
                    <div class="panel-body">
                    <table class="table table-striped table-hover">                      
                        <tr>
                            <th>Cantidad</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                        </tr>
                        @foreach($ventas->take(3)->get() as $venta)              
                        <tr>
                            <td>{{$venta->cantidad}}</td>
                            <td>{{$venta->producto->descripcion}}</td>
                            <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y')}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </section>

VUE THINGS
<ul>
  <li v-for="skill in skills" v-text="skill"></li>
</ul>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

@endsection
