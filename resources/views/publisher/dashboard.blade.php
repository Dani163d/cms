@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header con stats -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-[#02311a] mb-3">
                Panel de Publicación
                <span class="block text-base font-normal text-gray-600 mt-1">
                    Sistema de gestión de noticias y contenido
                </span>
            </h1>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
                    <div class="flex items-center">
                        <div class="bg-indigo-50 rounded-xl p-2">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-gray-500 text-xs">Total de Publicaciones</h3>
                            <p class="text-lg font-bold text-gray-900">{{ $news->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
                    <div class="flex items-center">
                        <div class="bg-emerald-50 rounded-xl p-2">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-gray-500 text-xs">Última Publicación</h3>
                            <p class="text-lg font-bold text-gray-900">{{ $news->first() ? $news->first()->created_at->format('d M') : 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
                    <div class="flex items-center">
                        <div class="bg-purple-50 rounded-xl p-2">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-gray-500 text-xs">Vistas Totales</h3>
                            <p class="text-lg font-bold text-gray-900">2.4k</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
        <div class="mb-6 animate-fade-in">
            <div class="bg-green-50 border-l-4 border-green-400 p-3 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Tabs de Navegación -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button onclick="switchTab('editor')" class="tab-button active-tab px-4 py-2 text-sm font-medium focus:outline-none">
                        Nueva Publicación
                    </button>
                    <button onclick="switchTab('list')" class="tab-button px-4 py-2 text-sm font-medium focus:outline-none">
                        Publicaciones Existentes
                    </button>
                </nav>
            </div>

            <!-- Tab Editor -->
            <div id="editor-tab" class="tab-content p-6">
                <form action="{{ route('publisher.storeNews') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="title" class="block text-xs font-medium text-gray-700 mb-1">Título de la Publicación</label>
                        <input type="text" id="title" name="title" required
                            class="w-full px-3 py-2 rounded-lg border-gray-300 focus:ring-[#0cad56] focus:border-[#0cad56] shadow-sm transition-all"
                            placeholder="Escribe un título llamativo">
                    </div>
                    
                    <div>
                        <label for="content" class="block text-xs font-medium text-gray-700 mb-1">Contenido</label>
                        <textarea id="content" name="content" class="w-full px-3 py-2 rounded-lg border-gray-300 focus:ring-[#0cad56] focus:border-[#0cad56] shadow-sm" rows="5"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Publicar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tab Lista -->
            <div id="list-tab" class="tab-content hidden p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($news as $item)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-200">
                        @php
                            $doc = new DOMDocument();
                            libxml_use_internal_errors(true);
                            $doc->loadHTML($item->content);
                            libxml_clear_errors();
                            $xpath = new DOMXPath($doc);
                            $imgNode = $xpath->query("//img")->item(0);
                        @endphp

                        @if($imgNode)
                        <div class="relative h-40 overflow-hidden">
                            <img src="{{ $imgNode->getAttribute('src') }}" 
                                 alt="Imagen de la noticia"
                                 class="w-full h-full object-cover transition-transform duration-200 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        @else
                        <div class="h-40 bg-gradient-to-r from-[#02311a] to-[#0cad56] flex items-center justify-center">
                            <svg class="w-8 h-8 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif

                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-gray-500">{{ $item->created_at->format('d M, Y') }}</span>
                                <span class="text-xs text-gray-500">2.1k vistas</span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-3">
                                {!! Str::limit(strip_tags($item->content), 100) !!}
                            </p>

                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <a href="{{ route('publisher.editNews', $item->id) }}"
                                    class="inline-flex items-center px-3 py-2 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors text-xs">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Editar
                                </a>

                                <form action="{{ route('publisher.deleteNews', $item->id) }}" method="POST"
                                    onsubmit="return confirm('¿Confirmas que deseas eliminar esta publicación?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="inline-flex items-center px-3 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors text-xs">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tab-button {
    position: relative;
    color: #666;
    transition: all 0.3s;
}

.tab-button::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: transparent;
    transition: all 0.3s;
}

.tab-button:hover {
    color: #0cad56;
}

.active-tab {
    color: #0cad56;
}

.active-tab::after {
    background-color: #0cad56;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

.ck-editor__editable {
    min-height: 250px !important;
    max-height: 400px !important;
    overflow-y: auto !important;
}

/* Custom scrollbar for editor */
.ck-editor__editable::-webkit-scrollbar {
    width: 6px;
}

.ck-editor__editable::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.ck-editor__editable::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

.ck-editor__editable::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

<script>
function switchTab(tabName) {
    const tabs = document.querySelectorAll('.tab-content');
    const buttons = document.querySelectorAll('.tab-button');
    
    tabs.forEach(tab => tab.classList.add('hidden'));
    buttons.forEach(button => button.classList.remove('active-tab'));
    
    document.getElementById(`${tabName}-tab`).classList.remove('hidden');
    event.currentTarget.classList.add('active-tab');
}
</script>

@push('scripts')


<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    const formData = new FormData();
                    formData.append('image', file);

                    fetch('{{ route("publisher.upload.image") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.uploaded) {
                            resolve({
                                default: response.url
                            });
                        } else {
                            reject(response.error.message);
                        }
                    })
                    .catch(error => reject(error));
                }));
        }

        abort() {
            // Abort upload
        }
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    ClassicEditor
        .create(document.querySelector('#content'), {
            extraPlugins: [MyCustomUploadAdapterPlugin],
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
            image: {
                toolbar: [
                    'imageStyle:full',
                    'imageStyle:side',
                    '|',
                    'imageTextAlternative'
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection
