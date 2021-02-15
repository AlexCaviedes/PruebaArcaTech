
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
                        @canany(['universal', 'products'])
                            <li>
                                <a href="{{ route('products') }}">
                                    <i class="fa fa-gears"></i>
                                        <span data-hover="Productos">Categorias-Productos</span>
                                </a>
                            </li>
                        @endcanany
                    
                    @endif

                    <!--Menú equipos-->

                    @if(Request::is("products")) 
                        <li class="g_heading mb-2">Categorías de productos</li>
                        @canany(['universal', 'equipos'])
                        <li>
                            @foreach($categories as $categorie)
                                <a href="/products/{{$categorie->category}}/{{$categorie->id}}">
                                    <i class="fa fa-ellipsis-h"></i>
                                    <span data-hover="{{$categorie->category}}">{{$categorie->category}}</span>
                                </a>
                            @endforeach
                            
                        </li>
                        @endcanany 
                
                        @canany(['universal', 'products'])
                            <hr style="border: px solid #2a2c35; width: 94%; margin-left: 0;">
                                <li>
                                    <a href="/products/new_inventory"><i class="fa fa-plus-square" aria-hidden="true"></i><span data-hover="N. Producto">Nuevo Producto</span></a>
                                </li>
                            <hr style="border: px solid #2a2c35; width: 94%; margin-left: 0;">
                        @endcanany
                    @endif
                </ul>  
            </nav>         
                       
        </div>
    </div>
</div>
