<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    protected function indexLogin()
    {
        return view('usuarios.login');
    }

    protected function authenticate(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();

            $user = User::where('email',$data['email'])->first();
            if ($user != null) {
                if ($user->estado == '1') {
                    if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                        return response()->json([
                            'auth' => true,
                            'validate' => true
                        ]);
                    }
                    return response()->json([
                        'auth' => false,
                        'validate' => true,
                        'message' => 'Email o contraseña incorrecta'
                    ]);
                }
                return response()->json([
                    'auth' => false,
                    'validate' => true,
                    'message' => 'Este usuario está desactivado'
                ]);
            }
            return response()->json([
                'auth' => false,
                'validate' => true,
                'message' => 'Este usuario no está registrado'
            ]);
        }
    }

    protected function indexUser()
    {
        return view('usuarios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.registrar');
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
                'documento' => 'required|numeric|unique:users',
                'nombre' => 'required|max:255',
                'email' => 'required|max:255|email|unique:users',
                'rol'=>'required|min:1',
                'password' => 'required|confirmed|max:8'
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            $user = new User();
            $user->documento = $data['documento'];
            $user->nombre = $data['nombre'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->rol = $data['rol'];
            $user->estado = '1';
            $user->save();

            return response()->json([
                'validate' => true,
                'message' => 'Usuario registrado correctamente.'
            ]);
        }
    }

    public function consultar(){
        $users=User::select('id',
        'documento',
        'nombre',
        'email',
        'rol',
        'estado',
        'created_at as creado',
        'updated_at as actualizado')->get();
        $info['data']= $users;
        return $info;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('usuarios.consultar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        return view('usuarios.modificar', compact('user'));
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
            $validatedData=null;
            if(is_null($request->password) && is_null($request->password_confirmation)){
                $validatedData = Validator::make($request->all(), [
                    'documento' => 'required|numeric|unique:users,documento,'.$request->user_id,
                    'nombre' => 'required|max:255',
                    'email' => 'required|max:255|email|unique:users,email,'.$request->user_id,
                    'rol'=>'required|min:1'
                ]);
            }else{
                $validatedData = Validator::make($request->all(), [
                    'documento' => 'required|numeric|unique:users,documento,'.$request->user_id,
                    'nombre' => 'required|max:255',
                    'email' => 'required|max:255|email|unique:users,email,'.$request->user_id,
                    'rol'=>'required|min:1',
                    'password' => 'required|confirmed|max:8'
                ]);
            }

            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            $user = User::findOrFail($data['user_id']);
            $user->documento = $data['documento'];
            $user->nombre = $data['nombre'];
            $user->email = $data['email'];
            if(!(is_null($request->password) && is_null($request->password_confirmation))){
                $user->password = Hash::make($data['password']);
            }
            $user->rol = $data['rol'];
            $user->save();

            return response()->json([
                'validate' => true,
                'message' => 'Usuario modificado correctamente.'
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
            $user = User::findOrFail($id);
            $user->estado=$user->estado==1?0:1;
            $user->save();
            return response()->json(['result'=>true,'message' => 'El estado se cambió exitosamente.']);
        } catch (\Throwable $th) {
            return response()->json(['result'=>false,'message' => 'El estado no se cambió exitosamente.']);
        }
    }

    public function cambiarPassword(Request $request){
        if ($request->ajax()) {
            $validatedData = Validator::make($request->all(), [
                'password_antiguo' => 'required|password',
                'password' => 'required|confirmed|max:8'
            ]);

            if ($validatedData->fails()) {
                return response()->json([
                    'errors' => $validatedData->errors(),
                    'validate' => false
                ]);
            }
            $data = $validatedData->getData();
            $user =User::find(Auth::user()->id);
            $user->password = Hash::make($data['password']);
            if($user->save()!=1){
                return response()->json([
                    'validate' => false,
                    'message' => 'La contraseña no se pudo cambiar correctamente.'
                ]);
            }

            return response()->json([
                'validate' => true,
                'message' => 'Contraseña cambiada correctamente.'
            ]);
        }
    }
}
