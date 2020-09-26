<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InstalacionFisica;
use Illuminate\Support\Facades\Validator;

class GestionInstalacionFisicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instalacionesFisicas.gestionInstalaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instalacionesFisicas.gestionInstalaciones.registrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'descripcion' => 'required|max:255',
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            $Instalacion = new InstalacionFisica();
            $Instalacion->descripcion = $data['descripcion'];
            $Instalacion->estado = 1;
            $Instalacion->save();

            return response()->json([
                'validate' => true,
                'message' => 'Instalación física registrada correctamente.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('instalacionesFisicas.gestionInstalaciones.consultar');
    }

    public function consultar(){
        $instalaciones=InstalacionFisica::select('id',
        'descripcion',
        'estado',
        'created_at as creado',
        'updated_at as actualizado')->get();
        $info['data']= $instalaciones;
        return $info;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instalacion=InstalacionFisica::findOrFail($id);
        return view('instalacionesFisicas.gestionInstalaciones.modificar', compact('instalacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'descripcion' => 'required|max:255',
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            $Instalacion = InstalacionFisica::findOrFail($data['instalacion_id']);
            $Instalacion->descripcion = $data['descripcion'];
            $Instalacion->save();

            return response()->json([
                'validate' => true,
                'message' => 'Instalación física modificada correctamente.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $instalacion = InstalacionFisica::findOrFail($id);
            $instalacion->estado=$instalacion->estado==1?0:1;
            $instalacion->save();
            return response()->json(['result'=>true,'message' => 'El estado se cambió exitosamente.']);
        } catch (\Throwable $th) {
            return response()->json(['result'=>false,'message' => 'El estado no se cambió exitosamente.']);
        }
    }
}
