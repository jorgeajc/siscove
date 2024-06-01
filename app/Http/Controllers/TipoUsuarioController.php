<?php

namespace App\Http\Controllers;

use App\tipo_usuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{ 
    public function index()
    {
        $tipoUsuario = tipo_usuario::orderBy('id', 'DESC')->paginate();
        return view('tipoUsuario.index', compact('tipoUsuario'));
    } 
    public function create()
    {
        return view('tipoUsuario.create');
    } 
    public function store(Request $request)
    {
        $nuevoTipo = new tipo_usuario;

        $nuevoTipo->nombre =$request->nombre;
        $nuevoTipo->descripcion = $request->descripcion;

        $nuevoTipo->save();
        return redirect()->route('tipo_usuario.index');
    } 
    public function show(tipo_usuario $tipo_usuario)
    {
        //
    } 
    public function edit(tipo_usuario $tipo_usuario)
    {
        //
    }
 
    public function update(Request $request, tipo_usuario $tipo_usuario)
    {
        //
    } 
    public function destroy(tipo_usuario $tipo_usuario)
    {
        //
    }
}
