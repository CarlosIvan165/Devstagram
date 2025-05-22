<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Routing\Controllers\Middleware;

class PerfilController extends Controller
{
    
    public static function middleware(): array{
        return [
            new Middleware('auth')
        ];
    }

    public function index(){
        return view('perfil.index');
    }

    public function store(Request $request){
        $request->request->add(['username' => Str::slug($request->username)]);
        
        $request->validate([
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'description' ,
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');
            $manager = new ImageManager(new Driver());

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = $manager->read($imagen->getPathname());
            $imagenServidor->cover(1000, 1000);

            $imagenPath = public_path('perfiles').'/'. $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->description = $request->description;

        $usuario->save();
        return redirect()->route('posts.index', $usuario->username);
    }
}
