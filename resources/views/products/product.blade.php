@extends('layouts.app')
@foreach ($products as $product)
    @section('title') Listado de {{$product->categories->category}} @endsection
    @section('title_content') Listado de {{$product->categories->category}} @endsection
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
                    <a href="{{ url('/products') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Volver a menú principal
                    </a>
                    @foreach ($products as $product)
                        <form class="pull-right " method="GET" action="{{route('search',$product->categories->id)}}" >
                    @endforeach
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="fe fe-search"></i>
                                </span>
                                <input type="text"  name="product" class="form-control"  placeholder="Referencia o Marca" required min="1" maxlength="49">
                            </div>
                        </form>
                </div>
                <div class="card-body"> 
                @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  <div style="text-align:left;">
                    <b class="" >Cantidad de productos:</b> {{$total->id}}
                  </div>
                    <div class="table-responsive" style="text-align:center;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Referencia</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Diponible</th>
                                    <th scope="col">Precio Unitario</th>
                                    <th scope="col">Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                            @foreach($products as $product)
                                    
                                    <tr>
                                        <td>{{ $product->references->reference }}</td>
                                        <td>{{ $product->references->mark }}</td>
                                        <td>{{ $product->references->available }}</td>
                                        <td>{{ $product->unit_price }}$</td>
                                        <td>
                                            <a href="#ex1" onclick="venderProducto()" id="btn_modal" rel="modal:open"  class="btn btn-outline-secondary btn-sm" type="button">
                                                <i class="fa fa-cart-arrow-down"></i>
                                            </a>
                                            <a href="/products/see_product/{{$product->categories->category}}/{{$product->id}}" type="button" class="btn btn-outline-info btn-sm" title="Más informacion">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                            <form class="d-inline" method="POST" action="{{route('delete',$product->id)}}" id="FormDeleteTime" onsubmit = "return confirmarEliminar()" >
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
                    {{ $products->links('vendor.pagination.bootstrap-4')}} 
                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($products as $product)
<div id="modal" class="modal-dialog modal-dialog-centered" height="450px" width="450px">
    
    <form method="post" action="/products/sell_producto/{{$product->id}}" id="ex1" class="modal" style="text-align:center;">
    
       @csrf
       <div class="form-group col-12">
          <label name="category" for="categoria" class="label">Por Favor llene los siguientes campos<label>
       </div>
       <div class="row justify-content-center">
          <div class="form-group col-8">
            <input id="number" type="number" value="" name="total" value="" placeholder="cantidad de Articulos" class="form-control mb-2" required>
          </div>
          <div class="form-group col-8">
            <input  type="text" value="" name="name" value="" placeholder="Nombre Comprador" class="form-control mb-2" required min="1" maxlength="11">
          </div>
          <div class="form-group col-8">
            <input  type="text" value="" name="identification" value="" placeholder="Cedula Comprador" class="form-control mb-2" required  min="1" maxlength="11">
          </div>
          <div class="form-group col-8">
            <select name="method"  class="form-control " id="informacion" required>
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

