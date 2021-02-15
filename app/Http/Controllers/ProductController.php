<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use Illuminate\Support\Collection;


use \PDF;
use App\Category;
use App\Reference;
use App\Product;

class ProductController extends Controller
{

    public function index(Request $request)
    {   
        $categories = Category::all();
        return view('products.index',['categories'=>$categories]);
    }

    public function postInsertCategory(Request $request)
    {
        $categories = new Category(); 
        $categories->category=$request->category;
        $categories->save();
        
        if($categories->save())
        {
            return back()->with('mensaje','Datos agregados correctamente');
        }
        else{
            return back()->with('mensaje','Datos  no agregados'); 
        }
    }

    public function getNew()
    {
        $categories = Category::all(); 
        return view('products.create',['categories'=>$categories]);
    }

    public function getEdit($id){

        $json;
        $products = Product::with('references')-> findOrFail($id);
        $json = json_decode($products->amount);
        return view('products.edit',['products'=>$products, 'json'=>$json]);

    }

    public function postUpdate(Request $request, $id){

        $url; 
        unset($request['_token']);
        $data = json_encode( $request->input('quantities', []));

        $products = Product::with('references', 'categories')->where('id','=', $id)->first();
        $references = $products->references()->first();

        $url = $products->categories->category;
        $references->reference = $request->reference;
        $references->mark = $request->mark;
        $references->available = $request->available;
        $products->amount = $data;
        $products->unit_price = $request->unit_price;
        $references->save();
        $products->save();
        if($references->save() && $products->save()){

            return redirect('/products/see_product/'.$url.'/'.$id)->with('mensaje', 'Datos Modificados');
        }
        else{

            return redirect('/products/see_product/'.$url.'/'.$id)->with('mensaje', 'Datos no Modificados');
        }
    }

    public function getSearch(Request $request, $id){

        $products = DB::table('products')
                 ->select(DB::raw('count(*) as id'))
                 ->where('products.categories_id','=', $id)
                 ->get();

        foreach($products as $total)
        {
            $total;
        }

        $products = Product::with("references")->where('products.categories_id','=', $id)->whereHas('references', function(Builder $query) use ($request) {
            $query->where('reference','like', '%' . $request->get('product') . '%')
            ->orwhere('mark','like', '%' . $request->get('product') . '%');
        })->paginate(5);
        
        if($products->count() > 0)
        {
            return view('products.product',['products'=>$products, 'total' => $total]);
        }   
        else{
            
            $products->count()=="";
            return back()->with('mensaje', 'No se encontraron los datos esperados');
        }   
    }
    
    public function store(Request $request){

           
        $category = $request->category;
        $data = json_encode( $request->input('quantities', []));
        $objects = Category::where('id','=', $category)->get();
        foreach ($objects as $object)
        {
            $object->category;
        }
        

        $reference = new Reference();
        $reference->reference=$request->reference;
        $reference->mark=$request->mark;
        $reference->available=$request->available;
        $reference->save();
        $reference = Reference::select('id')->orderby('id','DESC')->first();

        $product = new Product(); 
        $product->amount = $data;
        $product->unit_price=$request->unit_price;
        $product->location=$request->location;
        $product['users_id'] = auth()->user()->id;
        $product->references_id = $reference->id;
        $product->categories_id = $category;
        $product->save();

        if($product->save() && $reference->save())
        {
            return back()->with('mensaje','Datos agregados correctamente');
        }
        else
        {
            return back()->with('mensaje','Ha ocudrrido un error al insertar los datos');
        }

    }

    public function getProducts(Request $request, $category, $id){

        $products = DB::table('products')
                 ->select(DB::raw('count(*) as id'))
                 ->where('products.categories_id','=', $id)
                 ->get();


        foreach($products as $total)
        {
            $total;
        }

        $products = Product::with('references', 'categories')->where('products.categories_id','=', $id)->paginate(5);


        return view('products.product', ['products' => $products, 'total' => $total]);
    }

    public function getSeeProduct($category, $id){ 
        
        $json;
        $products = Product::where('id', $id)->orderby('id','DESC')->first();
        
        $json = json_decode($products->	amount);
        return view('products.product-information',['products'=>$products, 'json'=>$json]); 

    }

    public function postSellProduct(Request $request, $id){
        
        $total=$request->total;
        $name=$request->name;
        $identification=$request->identification;
        $method = $request->method;
        $products = Product::with('references','categories')->where('id', $id)->orderby('id','DESC')->first();
        return view('products.sell-product', compact('products', 'method', 'identification', 'name', 'total'));
    }

    public function delete($id){

        $deleteProduct = Product::find($id);
        $deleteReference = Reference::find($deleteProduct->references_id);
        $deleteReference->delete();

        return back()->with('mensaje', 'Datos eliminados');
        
    }

    public function postInvoice($id){

        $idDelete;
        $idDelete = $id;
        $deleteProduct = Product::find($idDelete);
        $deleteReference = Reference::find($deleteProduct->references_id);
        $deleteReference->delete();

        $pdf = \PDF::loadview('products.index');
        return $pdf->download('FacturaCompra.pdf');

        if($deleteReference->delete()){
            return back()->with('mensaje', 'Venta Exitosa');
        }
        else{
            return back()->with('mensaje', 'Venta no exitosa');
        }
    }
}
