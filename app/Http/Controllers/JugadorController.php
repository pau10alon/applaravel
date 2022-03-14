<?php

namespace App\Http\Controllers;

use App\Models\jugador;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['jugadors']=jugador::paginate(3);
        return view('jugador.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('jugador.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request,$campos,$mensaje);

        $datosJugador = request()->except('_token');

        if ($request->hasFile('Foto')){
            $datosJugador['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Jugador::insert($datosJugador);
        
        //return response()-> json($datosJugador); 
        return redirect('jugador')->with('mensaje','Jugador agregado con éxito');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jugador  $jugador
     
     * @return \Illuminate\Http\Response
     */
    public function show(jugador $jugador){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $jugador = jugador::findOrFail($id);
        return view('jugador.edit', compact('jugador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email'
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La foto es requerida'];
        }



        $datosJugador = request()->except(['_token','_method']);
        if ($request->hasFile("Foto")){
            $jugador = jugador::findOrFail($id);
            Storage::delete('public/'.$jugador->Foto);
            $datosJugador['Foto']=$request->file('Foto')->store('uploads','public');
        }
        jugador::where('id','=',$id)->update($datosJugador);
        $jugador = jugador::findOrFail($id);
        //return view('jugador.edit', compact('jugador'));
        return redirect('jugador')->with('mensaje','Jugador modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jugador = jugador::findOrFail($id);
        if (Storage::delete('public/'.$jugador->Foto)){
            Jugador::destroy($id);
        }
        //
        return redirect('jugador')->with('mensaje','Jugador borrado');
    }
}
