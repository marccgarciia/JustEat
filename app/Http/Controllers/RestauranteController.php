<?php

namespace App\Http\Controllers;
use App\Mail\EnviarCorreo;
use Illuminate\Support\Facades\Mail;
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
    public function guia(Request $request){
        if (!$request->session()->has('email_user')){
            return redirect('/');
        } else {
            $data=DB::table('cocinas')->get();
            return view('guia',compact('data'));
        }
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
            'imagen_user' => '0.png',
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
                $request->session()->put(['email_user'=> $usuario['email_user'], 'is_admin' => '1']);
                //TE LLEVA A LA GUIA DE RESTAURANTES
                return redirect('/guia');
            }else{
                $request->session()->put(['email_user'=> $usuario['email_user'], 'is_admin' => '0']);
                //$request->session()->put('email_user', $usuario['email_user']);
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
        $value = $request->input('value');
        $buscar = $request->input('buscar');
        $query = "SELECT * FROM restaurantes";
        $whereConditions = [];
        if (!empty($buscar)) {
            $whereConditions[] = "nombre_restaurante LIKE '%".$buscar."%'";
        }
        if (!empty($value)) {
            $whereConditions[] = "tipo_comida = $value";
        }
        if (!empty($whereConditions)) {
            $query .= " WHERE " . implode(" AND ", $whereConditions);
        }
        $result = DB::select(DB::raw($query));
        return response()->json($result);
    }
    /* LISTAR TIPO COMIDA */
    public function listarTipoComida(Request $request){
        $resu0 = DB::select(DB::raw("SELECT * FROM cocinas"));
        return response()->json($resu0);
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
    /* CREA RESTAURANTE */
    public function crearRestaurante(Request $request){
        $restaurante = $request->except('_token');
        $id = Db::table('restaurantes')->insertGetId(['nombre_restaurante' => $restaurante['nombre_restaurante'],'tipo_comida' => $restaurante['tipo_comida'],'email_restaurante' => $restaurante['email_restaurante'],'descripcion_restaurante' => $restaurante['descripcion_restaurante'],'imagen_restaurante' => $restaurante['imagen_restaurante']]);
        if($request->hasFile("imagen_restaurante")){ 
            $request->file('imagen_restaurante')->storeAs('uploads', $id.'.png', 'public');
            Db::table('restaurantes')->where('id_restaurante', $id)->update(['imagen_restaurante' => $id.'.png']);
        }  
        return response()->json(['Resultado' => 'OK']);
    } 
    /* MUESTRA EL CONTENIDO */
    public function editarRestaurante(Request $request){
        // $request->except('_token');
        $id = $request->input('id_restaurante');
        $restaurante = Restaurante::find($id);
        return response()->json($restaurante);
    }
    public function actualizarRestaurante(Request $request, $id){
        $restaurante = Restaurante::findOrFail($id);
        $restaurante->fill($request->only([
            'nombre_restaurante',
            'tipo_comida',
            'email_restaurante',
            'descripcion_restaurante'
        ]));
        if ($request->hasFile('imagen_restaurante')) {
            $imagen = $request->file('imagen_restaurante');
            $nombre_imagen = time().'.'.$imagen->extension();
            $imagen->move(public_path('/storage/uploads'), $nombre_imagen);
            $restaurante->imagen_restaurante = $nombre_imagen;
        }
        $restaurante->save();
        Mail::to($restaurante->email_restaurante)
            ->send(new EnviarCorreo([
                'sub' => "ACTUALIZACION DE RESTAURANTE " . $restaurante->email_restaurante,
                'msg' => 'Mensaje',
                'nombre_restaurante' => $restaurante->nombre_restaurante,
                'email_restaurante' => $restaurante->email_restaurante,
                'tipo_comida' => $restaurante->tipo_comida,
                'descripcion_restaurante' => $restaurante->descripcion_restaurante
            ]));
        return response()->json(['Resultado' => 'OK']);
    }
    /* CRUD USER */
    public function crudUsers(){
        return view('crudUsers');
    }
    /* LISTAR USERS */
    public function listarUser(Request $request){
        $buscar = $request->input('buscar');
        if(empty($buscar)) {
            $resu1 = DB::select(DB::raw("SELECT * FROM users"));
            return response()->json($resu1);
        } else {
            $resu2 = DB::select(DB::raw("SELECT * FROM users WHERE (nombre_user LIKE '%".$buscar."%')"));
            return response()->json($resu2);
        }
    }
    /* ELIMINAR RESTAURANTE */
    public function eliminarUser(Request $request) {
        $id = $request->input('id');
        try {
            User::find($id)->delete();
            return response()->json(['Resultado' => "OK"]);
        } catch (\Throwable $e) {
            return response()->json(['Resultado' => 'Error, algo ha ido mal']);
        }
    }
    /* CREAR USER POST */
    public function crearUser(Request $request){
        $user = $request->except('_token');
        $nombre_usuario = $request->input('nombre_user');
        
        if(!$request->hasFile("imagen_user")){
            $id = Db::table('users')->insertGetId(['nombre_user' => $user['nombre_user'],'email_user' => $user['email_user'],'imagen_user' => '0.png','password_user' => '7c4a8d09ca3762af61e59520943dc26494f8941b']);
        }else{
            $id = Db::table('users')->insertGetId(['nombre_user' => $user['nombre_user'],'email_user' => $user['email_user'],'imagen_user' => $user['imagen_user'],'password_user' => '7c4a8d09ca3762af61e59520943dc26494f8941b']);
            $request->file('imagen_user')->storeAs('uploads', $id.$nombre_usuario.'.png', 'public');
            Db::table('users')->where('id_user', $id)->update(['imagen_user' => $id.$nombre_usuario.'.png']);
        }
        return response()->json(['Resultado' => 'OK']);  
    }
    /* EDITAR USER */
    public function editarUser(Request $request){
        $id = $request->input('id_user');
        $user = User::find($id);
        return response()->json($user);
    }
    /*ACTUALIZAR USER*/
    public function actualizarUser(Request $request, $id){
        $user = User::findOrFail($id);
        $user->nombre_user = $request->nombre_user;
        $user->email_user = $request->email_user;
        $imagen = $request->file('imagen_user');
        if ($imagen) {
            $nombre_imagen = time().'.'.$imagen->extension();
            $imagen->move(public_path('/storage/uploads'),$nombre_imagen);
            $user->imagen_user = $nombre_imagen;
        }
        $user->update();
        return response()->json(['Resultado' => 'OK']);
    }
    /* INFO RESTAURANTE*/
    public function infoRestaurante(Request $request, $id){
        $consulta=DB::table('restaurantes')->where('id_restaurante',$id)->get();
        $consulta1=DB::table('restaurantes')->join('cocinas', 'cocinas.id_cocina', '=', 'restaurantes.tipo_comida')->where('restaurantes.id_restaurante', '=', $id)->get();
        $consulta2=DB::table('comentarios')->join('restaurantes', 'restaurantes.id_restaurante','=','comentarios.id_restaurante')->where('comentarios.id_restaurante','=',$id)->get();
        $consulta3=DB::table('users')->get();
        return view('inforestaurantes', compact('consulta','consulta1','consulta2','consulta3'));
    }

    public function valoraciones(Request $request){
        $valoracion= $request->except('_token');
        $sesion=session()->get('id_user');
        $nota=2;
        $parte=$request->headers->get('referer');
        $id=explode("/", $parte);
    
        $consulta=DB::table('comentarios')->where('id_restaurante','=', end($id))->where('id_user','=',$sesion)->count();
        if($consulta==1){
            $resultado="";
        }else{
            if(empty($request['comentario'])){
                $request="";
            }
            DB::table('comentarios')->insertGetId(['id_restaurante'=>end($id),'id_user'=>2, 'nota'=>$nota,'comentario'=>$request['comentario']]);
    
            $media=DB::table('comentarios')->select('nota')->where('id_restaurante','=', end($id))->get();
            $users=DB::table('comentarios')->where('id_restaurante','=',end($id))->count();
            $nueva_media=0;
            foreach($media as $media_user){
                $nueva_media += $media_user->nota;
            }
    
            $resultado=$nueva_media/$users;
            DB::table('restaurantes')->where('id_restaurante','=',end($id))->update(['media'=>$resultado]);
            return view('/guia');
        }
    }
}

