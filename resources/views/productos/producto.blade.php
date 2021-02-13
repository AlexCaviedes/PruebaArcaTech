@extends('layouts.app')
@foreach ($productos as $producto)
    @section('title') Listado de {{$producto->categorias->Categoria}} @endsection
    @section('title_content') Listado de {{$producto->categorias->Categoria}} @endsection
@endforeach


{{--{{dd(json_decode( $producto->Cantidad))}}--}}
@section('MyScripts')
<script src="{{ asset('assets/js/productos.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection

@section('content')

<div class="container" id="equipo_1">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ url('/productos') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Volver a menú principal
                    </a>
                    @foreach ($productos as $producto)
                        <form class="pull-right " method="GET" action="{{route('busqueda',$producto->categorias->id)}}" >
                    @endforeach
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="fe fe-search"></i>
                                </span>
                                <input type="text"  name="producto" class="form-control"  placeholder="Referencia o Marca" required min="1" maxlength="49">
                            </div>
                        </form>
                </div>
                <div class="card-body"> 
                @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  <div style="text-align:left;">
                    <b class="" >Cantidad de productos:</b> {{$total->Tipo}}
                  </div>
                    <div class="table-responsive" style="text-align:center;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Referencia</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Diponible</th>
                                    <th scope="col">Fecha Caducidad</th>
                                    <th scope="col">Precio Unitario</th>
                                    <th scope="col">Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                            @foreach($productos as $producto)
                                    
                                    <tr>
                                        <td>{{ $producto->referencias->Referencia }}</td>
                                        <td>{{ $producto->referencias->Marca }}</td>
                                        <td>{{ $producto->referencias->Estado }}</td>
                                        <td>{{ $producto->FechaCaducidad }}</td>
                                        <td>{{ $producto->PrecioUnitario }}$</td>
                                        <td>
                                            <a href="#ex1" onclick="venderProducto()" id="btn_modal" rel="modal:open"  class="btn btn-outline-secondary btn-sm" type="button">
                                                <i class="fa fa-cart-arrow-down"></i>
                                            </a>
                                            <a href="/productos/ver_producto/{{$producto->categorias->Categoria}}/{{$producto->id}}" type="button" class="btn btn-outline-info btn-sm" title="Más informacion">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                            <form class="d-inline" method="POST" action="{{route('EliminarProducto',$producto->id)}}" id="FormDeleteTime" onsubmit = "return confirmarEliminar()" >
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-outline-danger btn-sm " aria-hidden="true"  type="submit" title="Eliminar">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    {{ $productos->links('vendor.pagination.bootstrap-4')}} 
                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($productos as $producto)
<div id="modal" class="modal-dialog modal-dialog-centered" height="450px" width="450px">
    
    <form method="post" action="/productos/vender_producto/{{$producto->categorias->Categoria}}/{{$producto->id}}" id="ex1" class="modal" style="text-align:center;">
    
       @csrf
       <div class="form-group col-12">
          <label name="Categoria" for="categoria" class="label">Por Favor llene los siguientes campos<label>
       </div>
       <div class="row justify-content-center">
          <div class="form-group col-8">
            <input id="numero" type="number" value="" name="cantidad" value="" placeholder="cantidad de Articulos" class="form-control mb-2" required>
          </div>
          <div class="form-group col-8">
            <input  type="text" value="" name="nombre" value="" placeholder="Nombre Comprador" class="form-control mb-2" required min="1" maxlength="11">
          </div>
          <div class="form-group col-8">
            <input  type="text" value="" name="cedula" value="" placeholder="Cedula Comprador" class="form-control mb-2" required  min="1" maxlength="11">
          </div>
          <div class="form-group col-8">
            <select name="metodo"  class="form-control " id="informacion" required>
                <option name="" >Metodo de pago</option>
                <option name="" >Electrónico</option>
                <option name="" >Otro</option>
            </select>
          </div>
          <br>
          <br>
          <button id="agregar" class="btn btn-primary btn-block" type="submit">Continuar</button>
       </div>
    </form>
 </div>
 @endforeach
@endsection

