@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Encabezado -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Panel de Publicador</h1>
            <p class="text-gray-600">Gestiona y publica contenido de manera eficiente</p>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Formulario de creación -->
        <div class="bg-white rounded-xl shadow-lg mb-12 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800">Crear Nueva Noticia</h2>
            </div>
            <form action="{{ route('publisher.storeNews') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Título</label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Ingresa el título de la noticia">
                </div>
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Contenido</label>
                    <textarea id="content" name="content"></textarea>
                </div>
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-all duration-300">
                        Publicar Noticia
                    </button>
                </div>
            </form>
        </div>

        <!-- Lista de noticias -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Noticias Publicadas</h2>
            <div class="space-y-6">
                @foreach ($news as $item)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $item->title }}</h3>
                            @if($item->image)
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" 
                                    class="w-full h-64 object-cover rounded-lg mb-6">
                            @endif
                            <div class="prose max-w-none text-gray-600 mb-6">
                                {!! $item->content !!}
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm">{{ $item->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex space-x-4">
                                    <a href="{{ route('publisher.editNews', $item->id) }}"
                                        class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar
                                    </a>
                                    <form action="{{ route('publisher.deleteNews', $item->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta noticia?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="inline-flex items-center text-red-600 hover:text-red-800 font-medium">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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