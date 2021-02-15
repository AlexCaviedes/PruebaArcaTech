@extends('layouts.app')

@section('title') Nuevo inventario @endsection
@section('title_content') Nuevo inventario @endsection

@section('MyScripts')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="{{ asset('assets/js/productos.js') }}"></script>
@endsection

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <a href="{{ route('products') }}" class="btn btn-primary btn-sm">Volver a menú principal</a>
               <a href="#ex1" onclick="insertCategori()" id="btn_modal" rel="modal:open"  class="btn btn-primary btn-sm">
                  Agregar categoria
              </a>
            </div>
            <div class="card-header d-flex justify-content-between align-items-center">
            </div>
            <div class="card-body">
               @if (session('mensaje'))
               <div class="alert alert-success">{{ session('mensaje') }}</div>
               @endif
               <form method="POST" action="/new" >
                  @csrf
                  <div class="row">
                     <div class="form-group col-3">
                        <select   name="category"  class="form-control " id="categoria" required>
                           <option value="">Categoria</option>
                           @foreach($categories as $categorie)
                              <option value={{$categorie->id}} name="" >{{$categorie->category}}</option>
                           @endforeach
                        </select>
                     </div>
                     
                  </div>
                  <div class="row">
                     <div class="form-group col-3">
                        <input  type="text" name="reference" id="referencia" placeholder="Referencia" class="form-control mb-2" required min="1" maxlength="49"/>
                     </div>
                     <div class="form-group col-3">
                        <input  type="text" name="mark" id="marca" placeholder="Marca" class="form-control  mb-2" required min="1" maxlength="29"/>
                     </div>
                     <div class="form-group col-3">
                        <select   name="available"  class="form-control " id="estado" required>
                           <option value="">Disponible</option>
                           <option  value="Si" name="si" id="si">Si</option>
                           <option  value="No" name="no" id="no">No</option>
                        </select>
                     </div>
                     <div class="form-group col-3">
                        <input  type="number" name="unit_price" id="valor" placeholder="Precio Unitario" class="form-control mb-2" required min="1" maxlength="11"/>
                     </div>
                  </div>
                  <div class="row">
                     
                     <div class="form-group col-3">
                        <input  type="text" name="location" id="Ubicacion" placeholder="Ubicacion" class="form-control  mb-2" required min="1" maxlength="30"/>
                     </div>
                  </div>
                  <div class="field_wrapper row">
                     <div class="input-group">
                        <input type="text" class="form-control mb-2 col-md-11" name="quantities[]" placeholder="Caracteristicas Producto" required min="1" maxlength="533"/>
                        <a href="javascript:void(0);" class="add_button form-group col-1 " title="Agregar casilla"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                     </div>
                 </div>
                 
                  <br>
                  <button id="agregar" class="btn btn-primary btn-block" type="submit">Agregar</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="modal" class="modal-dialog modal-dialog-centered" height="450px" width="450px">
   <form method="POST" action="/products/insert_categori" id="ex1" class="modal" style="text-align:center;">
      @csrf
      <div class="form-group col-12">
         <label name="Categoria" for="categoria" class="label">Agrega una categoria<label>
      </div>
      <div class="row justify-content-center">
         <div class="form-group col-8">
               <input  type="text" name="category" placeholder="Categoria" class="form-control mb-2" required min="1" maxlength="49"/>
         </div>
         <br>
         <button id="agregar" class="btn btn-primary btn-block" type="submit">Agregar</button>
      </div>
   </form>
</div>
@endsection