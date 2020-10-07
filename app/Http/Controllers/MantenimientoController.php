<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mantenimiento;
use Illuminate\Support\Facades\Validator;
use App\InstalacionFisica;
use Illuminate\Support\Facades\DB;
use App\ConfiguracionMantenimiento;
use Illuminate\Support\Carbon;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instalacionesFisicas.mantenimientos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instalaciones = InstalacionFisica::where('estado',1)->get();
        return view('instalacionesFisicas.mantenimientos.registrar', compact('instalaciones'));
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
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'tipo'=>'required|min:1',
                'instalacion' => 'required|min:1',
                'fecha' => 'required|date',
                'fecha_proxima' => 'nullable|date'
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            $Mantenimiento = new Mantenimiento();
            $Mantenimiento->tipo = $data['tipo'];
            $Mantenimiento->id_instalacion = $data['instalacion'];
            $Mantenimiento->fecha = $data['fecha'];
            if($Mantenimiento->tipo==1){
                if(is_null($request->fecha_proxima)){
                    return response()->json([
                        'result' => false,
                        'message' => 'El mantenimiento no se pudo registrar correctamente.'
                    ]);
                }
                $Mantenimiento->fecha_proxima = $data['fecha_proxima'];
            }
            if(!is_null($request->documento)){
                $nombreDocumento = $request->file('documento')->store('public/mantenimientos'); // Upload
                $Mantenimiento->documento = $nombreDocumento;
            }
            $Mantenimiento->save();

            return response()->json([
                'result' => true,
                'validate' => true,
                'message' => 'Mantenimiento registrado correctamente.'
            ]);
        }
    }

    function getFechaProxima($id_instalacion, $fecha){
        $configuracion=ConfiguracionMantenimiento::where('id_instalacion',$id_instalacion)->first();
        if($configuracion==null){
            return response()->json([
                'result' => false,
                'message' => 'No se encontró un periodo para el mantenimiento de esta instalación.'
            ]);
        }
        $date = new Carbon($fecha);
        $date->addDays($configuracion->periodo_dias);
        return response()->json([
            'result' => true,
            'fecha_proxima' => $date->toDateString()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('instalacionesFisicas.mantenimientos.consultar');
    }

    public function consultar(){
        $mantenimientos=Mantenimiento::select(
        'mantenimientos.id',
        'mantenimientos.tipo',
        'instalaciones_fisicas.descripcion as instalacion',
        'mantenimientos.fecha',
        'mantenimientos.fecha_proxima',
        'mantenimientos.created_at as creado',
        'mantenimientos.updated_at as actualizado')
        ->join('instalaciones_fisicas', 'instalaciones_fisicas.id', 'mantenimientos.id_instalacion')
        ->get();
        $info['data']= $mantenimientos;
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
        //
        $mantenimiento=Mantenimiento::findOrFail($id);
        $instalaciones = InstalacionFisica::where('estado',1)->get();
        return view('instalacionesFisicas.mantenimientos.modificar', compact('mantenimiento','instalaciones'));
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
        //
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'tipo'=>'required|min:1',
                'instalacion' => 'required|min:1',
                'fecha' => 'required|date',
                'fecha_proxima' => 'nullable|date'                    
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            try {
                $data = $validatedData->getData();
                $mantenimiento = Mantenimiento::findOrFail($data['id']);
                if(!is_null($request->documento)){
                    \Storage::delete($mantenimiento->documento);
                    $nombreDocumento = $request->file('documento')->store('public/mantenimientos'); // Upload
                    $mantenimiento->documento = $nombreDocumento;
                }
                
                $mantenimiento->tipo = $data['tipo'];
                $mantenimiento->id_instalacion = $data['instalacion'];
                $mantenimiento->fecha = $data['fecha'];
                if($mantenimiento->tipo==1){
                    if(is_null($request->fecha_proxima)){
                        return response()->json([
                            'result' => false,
                            'message' => 'El mantenimiento no se pudo registrar correctamente.'
                        ]);
                    }
                    $mantenimiento->fecha_proxima = $data['fecha_proxima'];
                }else{
                    $mantenimiento->fecha_proxima = null;
                }
                if(!$mantenimiento->save()){
                    throw new Exception();
                }
                return response()->json([
                    'validate' => true,
                    'result'=>true,
                    'message' => 'Mantenimiento modificado correctamente.'
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'validate' => true,
                    'result'=>false,
                    'message' => 'El mantenimiento no se pudo modificar correctamente.'
                ]);
            }            
        }
    }


    public function ver($id){
        $mantenimiento=Mantenimiento::findOrFail($id);
        $mantenimiento->documento=str_replace('public/','',$mantenimiento->documento);
        return view('instalacionesFisicas.mantenimientos.ver', compact('mantenimiento'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $mantenimiento=Mantenimiento::findOrFail($id);
            if($mantenimiento->delete()){   
                \Storage::delete($mantenimiento->documento);             
                return response()->json([
                    'result'=>true,
                    'message' => 'El mantenimiento fue eliminado correctamente.'
                ]);
            }            
            return response()->json([
                'result'=>false,
                'message' => 'El mantenimiento no fue eliminado correctamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'result'=>false,
                'message' => 'El mantenimiento no fue eliminado correctamente.'
            ]);
        }    
    }
}
