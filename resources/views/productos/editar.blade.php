@extends('layouts.app')

@section('title') Modificar @endsection

@section('title_content') Modificar @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">     
                 
                <form method="POST" action="{{route('update', $productos->id)}}">
                    @csrf
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="nombre" class="control-label">Referencia</label>
                                <input id="id_referencia"  type="text" name="referencia" placeholder="Referencia" class="form-control mb-2" value="{{ $productos->referencias->Referencia }}" required min="1" maxlength="49"/>
                            </div>
                            <div class="form-group col-3">
                                <label for="nombre" class="control-label">Marca</label>
                                <input id="id_marca"  type="text" name="marca" placeholder="marca" class="form-control mb-2"  value="{{ $productos->referencias->Marca }}" required min="1" maxlength="29"/>
                            </div>
                            <div class="form-group col-3">
                                <label for="nombre" class="control-label">Disponible</label>
                                <select id="id_estado"  name="estado" id="select" class="form-control" required>

                                    <option  value="">Disponible</option>
                                    <option {{ $productos->referencias->Estado == 'Si' ? 'selected' : '' }} value="si" name="si" id="activo">Si</option>
                                    <option {{ $productos->referencias->Estado == 'No' ? 'selected' : '' }} value="no" name="no" id="Inactivo">No</option>

                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="precio" class="control-label">Precio Unitario</label>
                                <input  type="text" name="valor" id="valor" placeholder="Precio Unitario" class="form-control mb-2" value="{{ $productos->PrecioUnitario }}" required min="1" maxlength="11"/>
                            </div>
                            @foreach($json as $total)
                            <div class="form-group col-3">
                                <label for="nombre" class="control-label">Caracteriasticas</label>
                                <input id="id_ficha"  type="text" name="cantidades[]" placeholder="Ubicación" class="form-control mb-2" value="{{ $total }}" required min="1" maxlength="533"/>
                            </div>
                            @endforeach
                        </div>
                    <button class="btn btn-primary btn-block" type="submit" id="agregar" >¡Actualizar!</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection