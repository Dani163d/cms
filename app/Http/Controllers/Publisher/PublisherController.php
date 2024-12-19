<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function dashboard()
    {
        // Obtener todas las noticias
        $news = News::all(); // O usa el método adecuado según el filtro que necesites (por ejemplo, `latest()`)
    
        // Pasar las noticias a la vista
        return view('publisher.dashboard', compact('news'));
    }
    

    public function storeNews(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Crear la noticia
            $news = new News();
            $news->title = $validated['title'];
            $news->content = $validated['content'];
            $news->user_id = Auth::id(); // Asignar el ID del usuario autenticado
    
            // Guardar la noticia en la base de datos
            $news->save();
    
            // Redirigir al dashboard con un mensaje de éxito
            return view('noticias', compact('news'));
        }
    
        // Si no está autenticado, redirigir al login
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para publicar una noticia.');
    }
    


}
