@extends('layouts.app')

@section('title') Información del producto @endsection
@section('title_content') Información del producto @endsection


@section('MyScripts')
<script src="{{ asset('assets/js/productos.js') }}"></script>
@endsection


@section('content')

<div class="container" id="equipo_2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="container">
                    <div class="row">
                        <div class="card-header col-sm float-left">
                            @php
                                $name = $products->categories->category
                            @endphp

                            @php
                                $id = $products->categories->id
                            @endphp
                            
                            @if($products->categories->category)
                                <a href="{{ url('/products/'.$name.'/'.$id) }}" class="btn btn-primary btn-sm col-md-6" >
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    Volver
                                </a>
                            @endif

                        </div>
                        <div class=" card-header col-sm float-right">
                            <a href="{{route('modify',$products->id)}}" class="btn btn-outline-info btn-sm col-md-12" id="modificar" onclick = "return confirmarModificar()" >
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Modificar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif 
                    <div  style="text-align:center;"> 
                    <table class="table table-hover">
                        <thead> 
                            <tr>
                                <th scope="col">Ubicacion</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Caracteristicas Producto</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $products->location }}</td>
                                    <td>{{ $products->users->name }}</td>
                                    <td>
                                        <select   name="informacion"  class="form-control " id="informacion" required>
                                            <option name="" >Caracteristicas</option>
                                            @foreach($json as $total)
                                                <option name="" >{{$total}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr> 
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection