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
        $news = News::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
    
        return view('publisher.dashboard', compact('news'));
    }
    
    public function showNews()
    {
        $allNews = News::orderBy('created_at', 'desc')->get();
        return view('noticias', compact('allNews'));
    }

    public function storeNews(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        try {
            $news = new News();
            $news->title = $validated['title'];
            $news->content = $validated['content'];
            $news->user_id = Auth::id();
            $news->save();

            return redirect()->route('publisher.dashboard')
                           ->with('success', 'Noticia publicada exitosamente');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Error al publicar la noticia: ' . $e->getMessage())
                           ->withInput();
        }
    }

    public function uploadImage(Request $request)
{
    if (!$request->hasFile('image')) {
        return response()->json([
            'error' => 'No image file uploaded'
        ], 400);
    }

    try {
        $file = $request->file('image');
        
        // Validar el archivo
        $validated = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Generar un nombre único para la imagen
        $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        
        // Guardar la imagen en storage/app/public/images
        $path = $file->storeAs('public/images', $fileName);
        
        // Generar la URL pública
        $url = Storage::url($path);

        return response()->json([
            'uploaded' => true,
            'url' => $url
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'Error al subir la imagen: ' . $e->getMessage()
            ]
        ], 500);
    }
}

    public function editNews($id)
    {
        $news = News::findOrFail($id);

        if ($news->user_id != Auth::id()) {
            return redirect()->route('publisher.dashboard')
                           ->with('error', 'No tienes permiso para editar esta noticia.');
        }

        return view('publisher.edit', compact('news'));
    }

    public function updateNews(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $news = News::findOrFail($id);

        if ($news->user_id != Auth::id()) {
            return redirect()->route('publisher.dashboard')
                           ->with('error', 'No tienes permiso para editar esta noticia.');
        }

        try {
            $news->title = $validated['title'];
            $news->content = $validated['content'];
            $news->save();

            return redirect()->route('publisher.dashboard')
                           ->with('success', 'Noticia actualizada con éxito.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Error al actualizar la noticia: ' . $e->getMessage())
                           ->withInput();
        }
    }

    public function deleteNews($id)
    {
        $news = News::findOrFail($id);

        if ($news->user_id != Auth::id()) {
            return redirect()->route('publisher.dashboard')
                           ->with('error', 'No tienes permiso para eliminar esta noticia.');
        }

        try {
            // Buscar imágenes en el contenido antes de eliminar
            preg_match_all('/<img[^>]+src="([^">]+)"/', $news->content, $matches);
            
            if (!empty($matches[1])) {
                foreach ($matches[1] as $src) {
                    // Obtener solo el nombre del archivo de la URL completa
                    $imagePath = str_replace('/storage/', 'public/', $src);
                    
                    // Eliminar la imagen del storage si existe
                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                }
            }

            $news->delete();

            return redirect()->route('publisher.dashboard')
                           ->with('success', 'Noticia eliminada con éxito.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Error al eliminar la noticia: ' . $e->getMessage());
        }
    }
}