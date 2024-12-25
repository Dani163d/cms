<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function editNews($id)
{
    // Obtener la noticia por ID
    $news = News::findOrFail($id);

    // Verificar si la noticia fue creada por el usuario autenticado
    if ($news->user_id != Auth::id()) {
        return redirect()->route('publisher.dashboard')->with('error', 'No tienes permiso para editar esta noticia.');
    }

    return view('publisher.edit', compact('news'));
}

public function updateNews(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    // Obtener la noticia por ID
    $news = News::findOrFail($id);

    // Verificar si la noticia fue creada por el usuario autenticado
    if ($news->user_id != Auth::id()) {
        return redirect()->route('publisher.dashboard')->with('error', 'No tienes permiso para editar esta noticia.');
    }

    // Actualizar la noticia
    $news->title = $validated['title'];
    $news->content = $validated['content'];
    $news->save();

    // Redirigir al dashboard con un mensaje de éxito
    return redirect()->route('publisher.dashboard')->with('success', 'Noticia actualizada con éxito.');
}

public function deleteNews($id)
{
    // Obtener la noticia por ID
    $news = News::findOrFail($id);

    // Verificar si la noticia fue creada por el usuario autenticado
    if ($news->user_id != Auth::id()) {
        return redirect()->route('publisher.dashboard')->with('error', 'No tienes permiso para eliminar esta noticia.');
    }

    // Eliminar la noticia
    $news->delete();

    // Redirigir al dashboard con un mensaje de éxito
    return redirect()->route('publisher.dashboard')->with('success', 'Noticia eliminada con éxito.');
}

public function uploadImage(Request $request)
{
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        
        if (!$image->isValid() || !in_array($image->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
            return response()->json(['error' => 'Archivo inválido'], 400);
        }

        $fileName = uniqid() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('public/uploads', $fileName);

        return response()->json([
            'url' => asset('storage/uploads/' . $fileName)
        ]);
    }

    return response()->json(['error' => 'No se encontró imagen'], 400);
}
  

}
