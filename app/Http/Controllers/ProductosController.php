<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use Illuminate\Support\Collection;

use Carbon\Carbon;
use App\Categoria;
use App\Referencia;
use App\Producto;

class ProductosController extends Controller
{
    public function index(Request $request)
    {   
        $categorias = \DB::table('categorias')
        ->select('Categoria', 'id')->get();
        return view('productos.index',['categorias'=>$categorias]);
    }

    public function insertarCategoria(Request $request)
    {
        $categorias = new Categoria(); 
        $categorias->Categoria=$request->Categoria;
        $categorias->save();
        
        if($categorias->save())
        {
            return back()->with('mensaje','Datos agregados correctamente');
        }
        else{
            return back()->with('mensaje','Datos  no agregados'); 
        }
    }

    public function nuevo()
    {
        $categorias = Categoria::all(); 
        return view('productos.crear',['categorias'=>$categorias]);
    }

    public function editar($id){

        $json;
        $productos = Producto::with('referencias')-> findOrFail($id);
        $json = json_decode($productos->Cantidad);
        return view('productos.editar',['productos'=>$productos, 'json'=>$json]);

    }

    public function update(Request $request, $id){

        $url; 
        unset($request['_token']);
        $datos = json_encode( $request->input('cantidades', []));

        $productos = Producto::with('referencias', 'categorias')->where('id','=', $id)->first();
        $referencias = $productos->referencias()->first();

        $url = $productos->categorias->Categoria;
        $referencias->Referencia = $request->referencia;
        $referencias->Marca = $request->marca;
        $referencias->Estado = $request->estado;
        $productos->Cantidad = $datos;
        $productos->PrecioUnitario = $request->valor;
        $referencias->save();
        $productos->save();
        if($referencias->save() && $productos->save()){

            return redirect('/productos/ver_producto/'.$url.'/'.$id)->with('mensaje', 'Datos Modificados');
        }
        else{

            return redirect('/productos/ver_producto/'.$url.'/'.$id)->with('mensaje', 'Datos no Modificados');
        }
    }

    public function busqueda(Request $request, $id){

        $productos = DB::table('productos')
                 ->select(DB::raw('count(*) as Tipo'))
                 ->where('productos.categorias_id','=', $id)
                 ->get();

        foreach($productos as $total)
        {
            $total;
        }

        $productos = Producto::with("referencias")->where('productos.categorias_id','=', $id)->whereHas('referencias', function(Builder $query) use ($request) {
            $query->where('Referencia','like', '%' . $request->get('producto') . '%')
            ->orwhere('Marca','like', '%' . $request->get('producto') . '%');
        })->paginate(5);
        
        if($productos->count() > 0)
        {
            return view('productos.producto',['productos'=>$productos, 'total' => $total]);
        }   
        else{
            
            $productos->count()=="";
            return back()->with('mensaje', 'No se encontraron los datos esperados');
        }   
    }
    
    public function store(Request $request){

        $ctg = $request->categoria;
        $datos = json_encode( $request->input('cantidades', []));
        $date = Carbon::now('America/Bogota');
        $objetos = \DB::table('categorias')->select('Categoria')->where('id','=', $ctg)->get();
        foreach ($objetos as $objeto){

        }
        $objeto->Categoria;

        $referencia = new Referencia();
        $referencia->Referencia=$request->referencia;
        $referencia->Marca=$request->marca;
        $referencia->Estado=$request->estado;
        $referencia->save();
        $rfn =Db::table("referencias")->select('id')->orderby('id','DESC')->first();

        $equipo = new Producto(); 
        $equipo->FechaCaducidad=$request->FechaCaducidad;
        $equipo->PrecioUnitario=$request->valor;
        $equipo->Fecha=$date;
        $equipo->Ubicacion=$request->ubicacion;
        $equipo->Cantidad = $datos;
        $equipo['users_id'] = auth()->user()->id;
        $equipo->referencias_id = $rfn->id;
        $equipo->categorias_id = $ctg;
        $equipo->save();

        $id_equipo=$equipo->id;

        if($equipo->save() && $referencia->save())
        {
            return back()->with('mensaje','Datos agregados correctamente');
        }
        else
        {
            return back()->with('mensaje','Ha ocudrrido un error al insertar los datos');
        }

    }

    public function productos(Request $request, $categoria, $id){

        $productos = DB::table('productos')
                 ->select(DB::raw('count(*) as Tipo'))
                 ->where('productos.categorias_id','=', $id)
                 ->get();

        foreach($productos as $total)
        {
            $total;
        }

        $productos = Producto::with('referencias', 'categorias')->where('productos.categorias_id','=', $id)->paginate(5);


        return view('productos.producto', ['productos' => $productos, 'total' => $total]);
    }

    public function verProducto($categoria, $id){ 
        
        $json;
        $productos = Producto::where('id', $id)->orderby('id','DESC')->first();
        
        $json = json_decode($productos->Cantidad);
        return view('productos.informacionproducto',['productos'=>$productos, 'json'=>$json]); 

    }

    public function venderProducto(Request $request, $categoria, $id){
        
        $total=$request->cantidad;
        $nombre=$request->nombre;
        $cedula=$request->cedula;
        $metodo = $request->metodo;
        $productos = Producto::with('referencias','categorias')->where('id', $id)->orderby('id','DESC')->first();
        return view('productos.venderproducto', compact('productos', 'metodo', 'cedula', 'nombre', 'total'));
    }

    public function eliminar($id){

        $eliminarProducto = Producto::find($id);
        $eliminarReferencia = Referencia::find($eliminarProducto->referencias_id);
        $eliminarReferencia->delete();

        return back()->with('mensaje', 'Datos eliminados');
        
    }

    public function imprimir($id, $categoria){

        
        $eliminarProducto = Producto::find($id);
        $eliminarReferencia = Referencia::find($eliminarProducto->referencias_id);
        $eliminarReferencia->delete();

        $pdf = PDF::loadview('productos.venderproducto');
        return $pdf->download('FacturaCompra.pdf');

        if($eliminarReferencia->delete()){

            return redirect('/productos/'.$categoria.'/'.$id)->with('mensaje', 'Venta exitosa');
        }
        else{

            return redirect('/productos/'.$categoria.'/'.$id)->with('mensaje', 'Venta no exitosa');
        }
    }
}
