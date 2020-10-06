<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ConfiguracionMantenimiento;
use App\InstalacionFisica;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMantenimiento()
    {
        return view('configuraciones.mantenimientos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMantenimiento()
    {
        $instalaciones = InstalacionFisica::where('estado',1)->get();
        return view('configuraciones.mantenimientos.registrar', compact('instalaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMantenimiento(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'instalacion' => 'required|min:1|unique:configuracion_mantenimientos,id_instalacion',
                'periodo_dias' => 'required|min:1|integer',
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            $ConfiguracionMantenimiento = new ConfiguracionMantenimiento();
            $ConfiguracionMantenimiento->id_instalacion = $data['instalacion'];
            $ConfiguracionMantenimiento->periodo_dias = $data['periodo_dias'];
            $ConfiguracionMantenimiento->save();

            return response()->json([
                'validate' => true,
                'message' => 'Configuración de mantenimiento registrado correctamente.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMantenimiento()
    {
        return view('configuraciones.mantenimientos.consultar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function consultarMantenimiento(){
        $configuracionesmantenimientos =ConfiguracionMantenimiento::select(
            'configuracion_mantenimientos.id',
            'instalaciones_fisicas.descripcion as instalacion',
            'configuracion_mantenimientos.periodo_dias',
            'configuracion_mantenimientos.created_at as creado',
            'configuracion_mantenimientos.updated_at as actualizado')
            ->join('instalaciones_fisicas', 'instalaciones_fisicas.id', 'configuracion_mantenimientos.id_instalacion')
            ->get();
            $info['data']= $configuracionesmantenimientos;
            return $info;
    }
    public function editMantenimiento($id)
    {
        $configuracion=ConfiguracionMantenimiento::findOrFail($id);
        $instalaciones = InstalacionFisica::where('estado',1)->get();
        return view('configuraciones.mantenimientos.modificar', compact('configuracion','instalaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMantenimiento(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'instalacion' => 'required|min:1|unique:configuracion_mantenimientos,id_instalacion,'.$request->id,
                'periodo_dias' => 'required|min:1|integer',                
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            $ConfiguracionMantenimiento = ConfiguracionMantenimiento::findOrFail($data['id']);
            $ConfiguracionMantenimiento->id_instalacion = $data['instalacion'];
            $ConfiguracionMantenimiento->periodo_dias = $data['periodo_dias'];
            if($ConfiguracionMantenimiento->save()!=1){
                return response()->json([
                    'validate' => false,
                    'message' => 'Configuración de mantenimiento no se modificó correctamente.'
                ]);    
            }

            return response()->json([
                'validate' => true,
                'message' => 'Configuración de mantenimiento modificado correctamente.'
            ]);           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMantenimiento($id)
    {
        try {
            $configuracion = ConfiguracionMantenimiento::findOrFail($id);
            if($configuracion->delete()){
                return response()->json(['result'=>true,
                'message' => 'La configuración se eliminó exitosamente.']);
            }
            return response()->json(['result'=>false,'message' => 'La configuración se eliminó exitosamente.']);
        } catch (\Throwable $th) {
            return response()->json(['result'=>false,'message' => 'La configuración se eliminó exitosamente.']);
        }
    }
}
