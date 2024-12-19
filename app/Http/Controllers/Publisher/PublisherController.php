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
    
    public function showNews()
    {
        // Obtener todas las noticias
        $allNews = News::all(); // O usa un filtro como latest() si prefieres las más recientes
    
        // Pasar las noticias a la vista
        return view('noticias', compact('allNews'));
    }

    // Método para guardar las noticias (ya lo tienes)
    public function storeNews(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        if (Auth::check()) {
            // Crear la noticia
            $news = new News();
            $news->title = $validated['title'];
            $news->content = $validated['content'];
            $news->user_id = Auth::id(); // Asignar el ID del usuario autenticado
    
            // Guardar la noticia
            $news->save();
    
            // Redirigir a la vista de noticias después de crearla
            return redirect()->route('noticias'); // Redirigir a la ruta de noticias
        }
    
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para publicar una noticia.');
    }
  

}
