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
        return view('/index');
    }
    /* LOGIN */
    public function login(){
        return view('login');
    }
    /* REGISTER */
    public function register(){
        return view('register');
    }
    /* GUIA DE RESTAURANTES */
    public function guia(){
        $data=DB::table('cocinas')->get();
        return view('guia',compact('data'));
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
    /* LISTAR ESTABLECIMIENTOS */
    public function listarRestaurantes(Request $request){
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
            return response()->json(['Resultado' => "OK"]);
        } catch (\Throwable $e) {
            return response()->json(['Resultado' => 'Error, algo ha ido mal']);
        }
    }


    public function crearRestaurante(Request $request){
        $restaurante = $request->except('_token');
        $id = Db::table('restaurantes')->insertGetId(['nombre_restaurante' => $restaurante['nombre_restaurante'],'tipo_comida' => $restaurante['tipo_comida'],'email_restaurante' => $restaurante['email_restaurante'],'descripcion_restaurante' => $restaurante['descripcion_restaurante'],'imagen_restaurante' => $restaurante['imagen_restaurante']]);

        if($request->hasFile("imagen_restaurante")){ 

            $request->file('imagen_restaurante')->storeAs('uploads', $id.'.png', 'public');

            Db::table('restaurantes')->where('id_restaurante', $id)->update(['imagen_restaurante' => $id.'.png']);
        }  

        return response()->json(['Resultado' => 'OK']);
        
    }
     
    public function editarRestaurante(Request $request){
        // $request->except('_token');
        $id = $request->input('id_restaurante');
        $restaurante = Restaurante::find($id);
        return response()->json($restaurante);
    }

    public function actualizarRestaurante(Request $request, $id){
        
        $restaurante = Restaurante::findOrFail($id);
        $restaurante->nombre_restaurante = $request->nombre_restaurante;
        $restaurante->tipo_comida = $request->tipo_comida;
        $restaurante->email_restaurante = $request->email_restaurante;
        $restaurante->descripcion_restaurante = $request->descripcion_restaurante;
        // $restaurante->imagen_restaurante = $request->imagen_restaurante;

        $imagen = $request->file('imagen_restaurante');
        if ($imagen) {
            $nombre_imagen = time().'.'.$imagen->extension();
            $imagen->move(public_path('/storage/uploads'),$nombre_imagen);
            $restaurante->imagen_restaurante = $nombre_imagen;
        }
        $restaurante->update();
        return response()->json(['Resultado' => 'OK']);
}
}

