<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function configuracion()
    {
        return view('user.configuracion');
    }

    public function actualizar(Request $request)
    {

        // Validaciones
        $validacion = $this->validate($request, [
            'fotoPerfil' => 'mimes:png,jpg|max:100',
            'nombre'  => 'required',
            'apellido' => 'required',
            'empresa' => 'required',
            'cargo' => 'required',
            'pais' => 'required',
            'direccion' => 'required',
            'movil' => 'required',
            'email' => 'required',
            'sobreMi' => 'required',
        ]);

        //Instacio Objeto
        $user = Auth::user();

        //Capturo informacion del formulario
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $empresa = $request->input('empresa');
        $cargo = $request->input('cargo');
        $pais = $request->input('pais');
        $direccion = $request->input('direccion');
        $movil = $request->input('movil');
        $email = $request->input('email');
        $sobreMi = $request->input('sobreMi');

        //Capturo pathName y fileName de la imagen
        $fotoPerfile = $request->file('fotoPerfil');

        //Seteo el Objeto
        $user->nombre = $nombre;
        $user->apellido = $apellido;
        $user->empresa = $empresa;
        $user->cargo = $cargo;
        $user->pais = $pais;
        $user->direccion = $direccion;
        $user->movil = $movil;
        $user->email = $email;
        $user->sobreMi = $sobreMi;

        //Valido si la imagen llega
        if ($fotoPerfile) {

            // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Sube
            $fotoPerfilPathName = time() . $fotoPerfile->getClientOriginalName();

            //Guardo la Imagen en la carpeta del Proyecto
            Storage::disk('users')->put($fotoPerfilPathName, File::get($fotoPerfile));

            // Seteo el Objeto con el Nombre Original del Usuario
            $user->fotoPerfil = $fotoPerfilPathName;
        }

        // Guardo
        $user->save();

        return redirect()->action('UserController@configuracion')
            ->with(['message' => 'Perfil Actualizado con Exito']);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function search(Request $request)
    {
        // /*  Es el valor capturado del Input */
        $term = $request->get('term');
        // /* http://127.0.0.1:8000/search?term=prueba2 */ /* Pruebo lo que me llega en el controlador */
        // return $term; 

        $querys = User::where('nombre', 'LIKE', '%' . $term . '%')->get();

        $data = [];

        foreach ($querys as $query) {
            $termArray = [];
            $termArray['id'] = $query->id;
            $termArray['value'] = $query->nombre;
            $termArray['label'] = '<img src="assets/img/profile-img.jpg" width="70" class="pointer">&nbsp' .  $query->nombre;
            $data[] = $termArray;
            // $data[] = [
            //     'label' => $query->nombre
            // ];
        };
        echo json_encode($data);
        // return $data;
    }
}
