<?php

namespace App\Http\Controllers;

use App\Exports\AlquiladoExport;
use App\Exports\disponibleExport;
use App\Exports\InventarioExport;
use App\Imports\InventarioImport;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventario = Inventario::all();
        return view("inventario.index", compact("inventario"));
        //
    }
    public function disponible()
    {
        $inventario = Inventario::where("disponibilidad", 1)->get();
        return view("disponible.index", compact("inventario"));
    }
    public function alquilado()
    {
    $inventario = Inventario::where("disponibilidad", 0)->get();
    return view("alquilado.index", compact("inventario"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'marca' => 'required|string',
            'precio' => 'required|numeric',
            'talla' => 'required|string',
            'tipo' => 'required|string',
            'color' => 'required|string',
             'disponibilidad' => 'nullable|string',
        ]);

            $producto = new Inventario;
            $producto->nombre = $request->input('nombre');
            $producto->marca = $request->input('marca');
            $producto->talla = $request->input('talla');
            $producto->precio = $request->input('precio');
            $producto->tipo = $request->input('tipo');
            $producto->color = $request->input('color');
            $producto->disponibilidad = $request->has('disponibilidad') && $request->input('disponibilidad') === 'on' ? 0 : 1;
            $producto->alquiler = $request->input('disponibilidad') === 'on' ? Carbon::now() :  null; // Establecerá la fecha y hora actual

      
            $producto->save();
            if($request->input('disponibilidad') === 'on'){
                return redirect()->route('orden.create')->with('id', $producto->id);
            }
            $success = array("message" => "Producto creado Satisfactoriamente", "alert" => "success");
            return redirect()->route('inventario.index')->with('success',$success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Inventario::find($id);
        return view('inventario.edit', compact('product'));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'marca' => 'required|string',
            'precio' => 'required|numeric',
            'talla' => 'required|string',
            'tipo' => 'required|string',
            'color' => 'required|string',
        ]);
    
        $producto = Inventario::findOrFail($id);
    
        $producto->nombre = $request->input('nombre');
        $producto->marca = $request->input('marca');
        $producto->talla = $request->input('talla');
        $producto->precio = $request->input('precio');
        $producto->tipo = $request->input('tipo');
        $producto->color = $request->input('color');
    
        $producto->update();
   
    
        $success = array("message" => "Producto actualizado satisfactoriamente", "alert" => "success");
        return redirect()->route('inventario.index')->with('success', $success);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Inventario::find($id)->delete();
        return redirect()->route('inventario.index')->with('success','Producto Eliminado.');
    }
    public function Exportacion(){
        return Excel::download(new InventarioExport(), 'Productos.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function ExportacionAlquilado(){
        return Excel::download(new AlquiladoExport(), 'Productos.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function ExportacionDisponible(){
        return Excel::download(new disponibleExport(), 'Productos.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function Importacion(Request $request) 
    {
        $archivo = $request->file('excel');


        if($archivo){
            Excel::import(new InventarioImport, $archivo);
 
            return redirect()->back()->with('success', 'Datos importados exitosamente');
        }

    }
    
}
