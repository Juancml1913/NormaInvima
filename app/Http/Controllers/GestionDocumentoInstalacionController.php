<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentoInstalacion;
use App\InstalacionFisica;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class GestionDocumentoInstalacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instalacionesFisicas.gestionDocumentos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instalaciones = InstalacionFisica::where('estado',1)->get();
        return view('instalacionesFisicas.gestionDocumentos.registrar', compact('instalaciones'));
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
                'descripcion' => 'required|max:255',
                'instalacion' => 'required|min:1',
                'documento' => 'required',
                
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            DB::beginTransaction();
            try {
                $data = $validatedData->getData();
                $documento = new DocumentoInstalacion();
                $nombreDocumento = $request->file('documento')->store('public/instalaciones'); // Upload
                $documento->documento = $nombreDocumento;
                $documento->descripcion = $data['descripcion'];
                $documento->id_instalacion=$data['instalacion'];
                if(!$documento->save()){
                    throw new Exception();
                }
                DB::commit();
                return response()->json([
                    'validate' => true,
                    'response'=>true,
                    'message' => 'Documento registrado correctamente.'
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json([
                    'validate' => true,
                    'response'=>false,
                    'message' => 'El documento no se pudo registrar correctamente.'
                ]);
            }            
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
        return view('instalacionesFisicas.gestionDocumentos.consultar');
    }

    public function consultar(){
        $documentos=DocumentoInstalacion::select('documentos_instalaciones.id',
        'documentos_instalaciones.descripcion',
        'instalaciones_fisicas.descripcion as instalacion',
        'documentos_instalaciones.created_at as creado',
        'documentos_instalaciones.updated_at as actualizado')
        ->join('instalaciones_fisicas', 'instalaciones_fisicas.id', 'documentos_instalaciones.id_instalacion')
        ->get();
        $info['data']= $documentos;
        return $info;
    }

    public function ver($id){
        $documento=DocumentoInstalacion::findOrFail($id);
        $documento->documento=str_replace('public/','',$documento->documento);
        return view('instalacionesFisicas.gestionDocumentos.ver', compact('documento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documento=DocumentoInstalacion::findOrFail($id);
        $instalaciones = InstalacionFisica::where('estado',1)->get();
        return view('instalacionesFisicas.gestionDocumentos.modificar', compact('documento','instalaciones'));
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
                'instalacion' => 'required|min:1'                    
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            DB::beginTransaction();
            try {
                $data = $validatedData->getData();
                $documento = DocumentoInstalacion::findOrFail($data['id_documento']);
                if(!is_null($request->documento)){
                    \Storage::delete($documento->documento);
                    $nombreDocumento = $request->file('documento')->store('public/instalaciones'); // Upload
                    $documento->documento = $nombreDocumento;
                }
                
                $documento->descripcion = $data['descripcion'];
                $documento->id_instalacion=$data['instalacion'];
                if(!$documento->save()){
                    throw new Exception();
                }
                DB::commit();
                return response()->json([
                    'validate' => true,
                    'response'=>true,
                    'message' => 'Documento modificado correctamente.'
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json([
                    'validate' => true,
                    'response'=>false,
                    'message' => 'El documento no se pudo modificar correctamente.'
                ]);
            }            
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
            $documento=DocumentoInstalacion::findOrFail($id);
            if($documento->delete()){   
                \Storage::delete($documento->documento);             
                return response()->json([
                    'result'=>true,
                    'message' => 'El documento fue eliminado correctamente.'
                ]);
            }            
            return response()->json([
                'result'=>false,
                'message' => 'El documento no fue eliminado correctamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'result'=>false,
                'message' => 'El documento no fue eliminado correctamente.'
            ]);
        }    
                    
    }
}
