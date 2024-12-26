@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Encabezado -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Editar Noticia</h1>
            <p class="text-gray-600">Actualiza el contenido de tu publicación</p>
        </div>

        <!-- Tarjeta del formulario -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">
                        Editando: {{ Str::limit($news->title, 50) }}
                    </h2>
                    <span class="text-sm text-gray-500">
                        Creado el: {{ $news->created_at->format('d/m/Y') }}
                    </span>
                </div>
            </div>

            <form action="{{ route('publisher.updateNews', $news->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('POST')

                <!-- Mensaje de error -->
                @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-sm text-red-700">
                            Por favor corrige los siguientes errores:
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Campo Título -->
                <div class="space-y-2">
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Título de la noticia
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $news->title) }}" 
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Ingresa el título de la noticia">
                </div>

                <!-- Campo Contenido -->
                <div class="space-y-2">
                    <label for="content" class="block text-sm font-medium text-gray-700">
                        Contenido de la noticia
                    </label>
                    <textarea id="content" 
                              name="content" 
                              required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ old('content', $news->content) }}</textarea>
                </div>

                <!-- Botones de acción -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('publisher.dashboard') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver
                    </a>
                    <div class="flex space-x-3">
                        <button type="reset" 
                                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Restaurar
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Actualizar Noticia
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.ck-editor__editable {
    min-height: 300px !important;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.bg-white {
    animation: fadeIn 0.5s ease-out forwards;
}
</style>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
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
        .then(editor => {
            // Guardar la referencia del editor
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });

    // Asegurar que el contenido del editor se envíe con el formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        document.querySelector('#content').value = editor.getData();
        this.submit();
    });
</script>
@endpush
@endsection