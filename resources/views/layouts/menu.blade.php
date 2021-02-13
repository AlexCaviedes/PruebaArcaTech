
<div id="left-sidebar" class="sidebar">
    <div class="d-flex justify-content-between brand_name">
        <h3 class="brand-name"><b>Arca Tech</b></h3>
    </div>
        <div class="input-icon">
            {{--<span class="input-icon-addon">
                <i class="fe fe-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Buscar...">--}}
        </div>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="all-tab">
            <nav class="sidebar-nav">
                <ul class="metismenu ci-effect-1">

                    <li class="mt-4"><a href="/"><i class="icon-home"></i><span data-hover="Dashboard">Dashboard</span></a></li>
                    <hr style="border: px solid #2a2c35; width: 94%; margin-left: 0;">
                    @if(Request::is("/")) 
                    <li class="g_heading mb-2">Modulos</li>
                        @canany(['universal', 'equipos'])
                            <li>
                                <a href="{{ route('productos') }}">
                                    <i class="fa fa-gears"></i>
                                        <span data-hover="C-P">Categorias-Productos</span>
                                </a>
                            </li>
                        @endcanany
                    
                    @endif

                    <!--Menú equipos-->

                    @if(Request::is("productos")) 
                        <li class="g_heading mb-2">Categorías de productos</li>
                        @canany(['universal', 'equipos'])
                        <li>
                            
                            @foreach($categorias as $categoria)
                                <a href="/productos/{{$categoria->Categoria}}/{{$categoria->id}}">
                                    <i class="fa fa-ellipsis-h"></i>
                                    <span data-hover="{{$categoria->Categoria}}">{{$categoria->Categoria}}</span>
                                </a>
                            @endforeach
                            
                        </li>
                        @endcanany 
                
                        @canany(['universal', 'equipos'])
                            <hr style="border: px solid #2a2c35; width: 94%; margin-left: 0;">
                                <li>
                                    <a href="/productos/nuevo_inventario"><i class="fa fa-plus-square" aria-hidden="true"></i><span data-hover="N. Producto">Nuevo Producto</span></a>
                                </li>
                            <hr style="border: px solid #2a2c35; width: 94%; margin-left: 0;">
                        @endcanany
                    @endif
                </ul>  
            </nav>         
                       
        </div>
    </div>
</div>
