<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $notificacion = Notificacion::where("id", $id)->first();
        if($notificacion->tipo == "Cumpleaños"){
            $notificacion->delete();
            return redirect()->route('cliente.index');
        }
        if($notificacion->tipo == "Alquiler"){
            $notificacion->delete();
            return redirect()->route('orden.index');
        }
        return redirect()->route('orden.index');    
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notificacion $notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notificacion $notificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notificacion $notificacion)
    {
        //
    }
}
