<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Restaurante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestauranteController extends Controller{
    /*------VISTAS----- */
    /* INDEX */
    public function index(){
        return view('index');
    }
    /* REGISTER */
    public function register(){
        return view('register');
    }
    /* GUIA DE RESTAURANTES */
    public function guia(){
        return view('guia');
    }
    /* REGISTERPOST */
    public function registerpost(Request $request){
            $request->validate([
            'nombre_user' => 'required|string|max:20',
            'email_user' => 'required|string|email|unique:users',
            'password_user' => 'required|string|min:6'
            ]); 
            User::create([
            'nombre_user' => $request->input('nombre_user'),
            'email_user' => $request->input('email_user'),
            'password_user' => sha1($request->input('password_user')),
            'is_admin' => '0'
            ]);
            return redirect('/');
    }
    /* LOGINPOST */
    public function loginpost(Request $request){
        $usuario = $request->except('_token');
        $existe = DB::table('users')->where('email_user','=',$usuario['email_user'])->where('password_user', sha1($usuario['password_user']))->count();
        $admin = DB::table('users')->where('is_admin','=',1)->where('email_user','=',$usuario['email_user'])->count();

        if ($existe == 1){
            if($admin == 1){
                $request->session()->put(['email_user',$usuario['email_user'], 'is_admin' => '1']);
                //TE LLEVA A LA GUIA DE RESTAURANTES
                return redirect('/guia');
            }else{
                $request->session()->put(['email_user',$usuario['email_user'], 'is_admin' => '0']);
                //TE LLEVA A LA GUIA DE RESTAURANTES
                return redirect('/guia');
            }
        }else{
            //TE LLEVA AL LOGUIN
            return redirect('/');
            
        } 
    }
    /* LOGOUT */
    public function logoutpost(Request $request){
        if (!$request->session()->has('email_user')){
            return redirect('/');
        } else {
            $request->session()->forget('email_user');
            $request->session()->flush();
            return redirect('/');
        }
    }
    /* LISTAR RESTAURANRES */
    public function listarRestaurantesAdmin(Request $request){
        $buscar = $request->input('buscar');
        if(empty($buscar)) {
            $resu1 = DB::select(DB::raw("SELECT * FROM restaurantes"));
            return response()->json($resu1);
        } else {
            $resu2 = DB::select(DB::raw("SELECT * FROM restaurantes WHERE (nombre_restaurante LIKE '%".$buscar."%')"));
            return response()->json($resu2);
        }
    }
    /* ELIMINAR RESTAURANTE */
    public function eliminarRestaurante(Request $request) {
        $id = $request->input('id');
        try {
            Restaurante::find($id)->delete();
            return response()->json(['Resultado' => 'OK']);
        } catch (\Throwable $e) {
            return response()->json(['Resultado' => 'Error, algo ha ido mal']);
        }
    }
}

