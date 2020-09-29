<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mantenimiento;
use Illuminate\Support\Facades\Validator;
use App\InstalacionFisica;

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
            if(!is_null($request->fecha_proxima)){
                $Mantenimiento->fecha_proxima = $data['fecha_proxima'];
            }
            if(!is_null($request->documento)){
                $nombreDocumento = $request->file('documento')->store('public/mantenimientos'); // Upload
                $Mantenimiento->documento = $nombreDocumento;
            }
            $Mantenimiento->save();

            return response()->json([
                'validate' => true,
                'message' => 'Mantenimiento registrado correctamente.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
