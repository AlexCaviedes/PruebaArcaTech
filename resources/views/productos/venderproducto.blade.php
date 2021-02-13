@extends('layouts.app')

@section('title') Vender Producto @endsection
@section('title_content') Vender Producto @endsection


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <img src="/assets/images/arca.png" width="270px" height="100px"/>

                    <b class="h3" >FACTURA ELECTRÓNICA
                        DE VENTA:
                        YBE645048
                    </b>

                    
                </div>
                <div class="card-body"> 
                    <form method="POST" action="/productos/imprimir_factura/{{$productos->id}}/{{$productos->$categorias->Categoria}}/{{$productos->categorias->id}}" >
                        @csrf
                        <div style="text-align:left;">
                            <b class="" >Empresa: </b>Arca Tech 
                        </div>
                            <div class="table-responsive" style="text-align:center;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nit</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Contacto</th>
                                            <th scope="col">Linea de Venta</th>
                                            <th scope="col">Nota</th>
                                            
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>890300794</td>
                                            <td>La Americas-Neiva</td>
                                            <td>www.Arcatech.com</td>
                                            <td>Desarrollo de Software</td>
                                            <td><b>PRODUCTOR RESPONSABLE FUERA DEL IVA</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="table-responsive" style="text-align:center;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Vendido A</th>
                                            <th scope="col">Cedula: </th>
                                            <th scope="col">Metodo de pago:</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$nombre}}</td>
                                            <td>{{$cedula}}</td>
                                            <td>{{$metodo}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive" style="text-align:center;">
                                
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Linea</th>
                                            <th scope="col">Codigo</th>
                                            <th scope="col">Descripcion</th> 
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio Unt</th> 
                                            <th scope="col">Total</th> 
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr>
                                            <td>{{$productos->categorias->id}}</td>
                                            <td>{{$productos->referencias->id}}{{$productos->id}}</td>
                                            <td>{{$productos->referencias->Referencia }}</td>
                                            <td> {{$total}}</td>
                                            <td>{{$productos->PrecioUnitario}} $</td>
                                            <td>{{$productos->PrecioUnitario*$total}} $</td>
                                        </tr>                                 
                                    </tbody>                               
                                </table>
                                <br>
                        <button  class="btn btn-primary btn-block" type="submit" >Generar Factura</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection