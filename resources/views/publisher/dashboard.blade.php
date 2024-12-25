@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-gradient-to-b from-gray-50 to-gray-100 py-16 px-4">
   <div class="max-w-4xl mx-auto w-full">
       <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Panel de Publicador</h1>

       @if (session('success'))
           <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
               {{ session('success') }}
           </div>
       @endif

       <div class="bg-white rounded-lg shadow-md p-6 mb-8">
           <h2 class="text-xl font-semibold mb-4 text-gray-700">Crear Nueva Noticia</h2>
           <form action="{{ route('publisher.storeNews') }}" method="POST" class="space-y-4">
           @csrf
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
        <input type="text" id="title" name="title" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
    </div>
    <div>
        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
        <textarea id="content" name="content" ></textarea>
    </div>
    <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition">
        Publicar Noticia
    </button>
</form>
       </div>

       <div class="space-y-6">
           <h2 class="text-2xl font-semibold text-gray-800 mb-6">Noticias Publicadas</h2>
           @foreach ($news as $item)
               <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                   <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $item->title }}</h3>
                   @if($item->image)
                       <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" 
                           class="w-full h-48 object-cover rounded-md mb-4">
                   @endif
                   <div class="text-gray-600 mb-4">{!! $item->content !!}</div>
                   <div class="flex items-center justify-between border-t pt-4 mt-4">
                       <p class="text-sm text-gray-500">
                           Publicado: {{ $item->created_at->format('d/m/Y') }}
                       </p>
                       <div class="flex space-x-4">
                           <a href="{{ route('publisher.editNews', $item->id) }}"
                               class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>
                           <form action="{{ route('publisher.deleteNews', $item->id) }}" method="POST"
                               onsubmit="return confirm('¿Confirmar eliminación?');">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Eliminar</button>
                           </form>
                       </div>
                   </div>
               </div>
           @endforeach
       </div>
   </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<style>
    .ck-editor__editable {
        min-height: 300px !important;
    }
</style>
<script>
    class CustomUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
    return this.loader.file.then(file => {
        const formData = new FormData();
        formData.append('image', file);
        
        return fetch('/upload-image', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .catch(error => {
            console.error('Error:', error);
            return Promise.reject('Upload failed');
        });
    });
}

        abort() {
            // Abort upload
        }
    }

    function CustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new CustomUploadAdapter(loader);
        };
    }

    ClassicEditor
        .create(document.querySelector('#content'), {
            extraPlugins: [CustomUploadAdapterPlugin],
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'uploadImage',
                    'blockQuote',
                    'insertTable',
                    'undo',
                    'redo'
                ]
            },
            language: 'es'
        })
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });

    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        document.querySelector('#content').value = editor.getData();
        this.submit();
    });
</script>
@endpush
@endsection