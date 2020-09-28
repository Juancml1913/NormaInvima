<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentoInstalacion;
use App\InstalacionFisica;
use Illuminate\Support\Facades\Validator;

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
            $data = $validatedData->getData();
            $documento = new DocumentoInstalacion();
            $nombreDocumento = $request->file('documento')->store('public/instalaciones'); // Upload
            $documento->documento = $nombreDocumento;
            $documento->descripcion = $data['descripcion'];
            $documento->id_instalacion=$data['instalacion'];
            $documento->save();

            return response()->json([
                'validate' => true,
                'message' => 'Documento registrado correctamente.'
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
        //
    }
}
