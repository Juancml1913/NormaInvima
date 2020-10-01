<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Indicador;

class IndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('indicadores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('indicadores.registrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'nombre' => 'required|max:255',
                'objetivo' => 'required|max:255',
                'alcance' => 'required|max:255',
                'numerador' => 'required|numeric',
                'denominador' => 'required|numeric',
                'complemento' => 'required|numeric',
                'responsables' => 'required|max:255',
                'unidad_medida' => 'required|max:255',
                'meta' => 'required|max:255',
                'sentido' => 'required|max:255',
                'frecuencia' => 'required|max:255'
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false,
                    'result' =>false
                ]);
            }
            $data = $validatedData->getData();
            $indicador = new Indicador();
            $indicador->nombre = $data['nombre'];
            $indicador->objetivo = $data['objetivo'];
            $indicador->alcance = $data['alcance'];
            $indicador->numerador = $data['numerador'];
            $indicador->denominador = $data['denominador'];
            $indicador->complemento = $data['complemento'];
            $indicador->responsables = $data['responsables'];
            $indicador->unidad_medida = $data['unidad_medida'];
            $indicador->meta = $data['meta'];
            $indicador->sentido = $data['sentido'];
            $indicador->frecuencia = $data['frecuencia'];
            if(!$indicador->save()){
                return response()->json([
                    'errors' => 'El indicador no se pudo registrar correctamente.',
                    'validate' => false,
                    'result' =>true
                ]);
            }

            return response()->json([
                'validate' => true,
                'result' =>true,
                'message' => 'Indicador registrado correctamente.'
            ]);
        }
    }

    public function consultar(){
        $indicadores=Indicador::select('id',
        'nombre',
        'numerador',
        'denominador',
        'complemento',
        'unidad_medida',
        'created_at as creado')->get();
        $info['data']= $indicadores;
        return $info;
    }

    public function ver($id){
        $indicador=Indicador::findOrFail($id);
        return view('indicadores.ver', compact('indicador'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('indicadores.consultar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $indicador = Indicador::findOrFail($id);
        if($indicador->delete()){
            return response()->json(['result'=>true,'message' => 'El indicador se eliminó exitosamente.']);
        }
        return response()->json(['result'=>false,'message' => 'El indicador no se pudo eliminar exitosamente.']);
    }
}
