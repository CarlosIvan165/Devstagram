<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public static function middleware(): array{
        return [
            new Middleware('auth', except:['show', 'index'])
        ];
    }

    public function index(User $user){
        
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        return view('dashboard', [
            'user'=>$user,
            'posts'=>$posts
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        /* $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]); */

        /* Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]); */

        // Otra forma de crear registro
       /*  $post = new post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save(); */

        /* dd($request->imagen, $request->titulo, $request->descripcion); */

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show',[
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();

        //Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
