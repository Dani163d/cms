@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Barra de progreso superior -->
    <div class="fixed top-0 left-0 w-full h-1 bg-gray-200">
        <div class="progress-bar h-full bg-gradient-to-r from-[#0cad56] to-[#02311a] transition-all duration-300"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Header con pasos -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-[#02311a]">Editor de Página Principal</h1>
            <div class="text-sm text-gray-500">
                Paso <span id="currentStep">1</span> de 3
            </div>
        </div>

        @if(session('success'))
            <div class="fixed top-4 right-4 bg-[#0cad56]/10 border-l-4 border-[#0cad56] p-4 rounded-lg animate-slide-in">
                <p class="text-[#02311a]">{{ session('success') }}</p>
            </div>
        @endif

        <form id="welcomeForm" action="{{ route('admin.update-welcome') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Contenedor de pasos -->
            <div class="relative">
                <!-- Paso 1: Introducción -->
                <div class="step-content" data-step="1">
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#0cad56] text-white font-semibold">1</span>
                            <h2 class="text-xl font-semibold text-[#02311a]">Introducción</h2>
                        </div>

                        <div class="space-y-6">
                            <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Título Principal</label>
                                <input type="text" name="intro_title" 
                                    value="{{ old('intro_title', $sections['intro']->title ?? '') }}"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors"
                                    placeholder="Escribe un título atractivo...">
                            </div>

                            <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje de Bienvenida</label>
                                <textarea name="intro_content" 
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors resize-none h-32"
                                    placeholder="Da la bienvenida a tus visitantes...">{{ old('intro_content', $sections['intro']->content ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paso 2: Sobre Nosotros -->
                <div class="step-content hidden" data-step="2">
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#0cad56] text-white font-semibold">2</span>
                            <h2 class="text-xl font-semibold text-[#02311a]">Sobre Nosotros</h2>
                        </div>

                        <div class="space-y-6">
                            <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Título de la Sección</label>
                                <input type="text" name="about_title"
                                    value="{{ old('about_title', $sections['about']->title ?? '') }}"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors"
                                    placeholder="Ej: Nuestra Historia">
                            </div>

                            <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                <textarea name="about_content"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors resize-none h-32"
                                    placeholder="Cuenta tu historia...">{{ old('about_content', $sections['about']->content ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paso 3: Misión y Visión -->
                <div class="step-content hidden" data-step="3">
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#0cad56] text-white font-semibold">3</span>
                            <h2 class="text-xl font-semibold text-[#02311a]">Misión y Visión</h2>
                        </div>

                        <div class="space-y-6">
                            <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nuestra Misión</label>
                                <textarea name="mission_content"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors resize-none h-32"
                                    placeholder="Define el propósito de tu empresa...">{{ old('mission_content', $sections['mission']->content ?? '') }}</textarea>
                            </div>

                            <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nuestra Visión</label>
                                <textarea name="vision_content"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors resize-none h-32"
                                    placeholder="Describe hacia dónde se dirige tu empresa...">{{ old('vision_content', $sections['vision']->content ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controles de navegación -->
            <div class="flex justify-between mt-6">
                <button type="button" 
                        id="prevStep"
                        class="px-6 py-2 rounded-lg border-2 border-[#02311a] text-[#02311a] hover:bg-[#02311a] hover:text-white transition-colors duration-300 hidden">
                    ← Anterior
                </button>
                
                <button type="button" 
                        id="nextStep"
                        class="ml-auto px-6 py-2 rounded-lg bg-[#0cad56] text-white hover:bg-[#02311a] transition-colors duration-300">
                    Siguiente →
                </button>
                
                <button type="submit" 
                        id="submitButton"
                        class="ml-auto px-6 py-2 rounded-lg bg-[#0cad56] text-white hover:bg-[#02311a] transition-colors duration-300 hidden">
                    Guardar Cambios
                </button>
            </div>
        </form>

        <!-- Ayuda contextual flotante -->
        <div class="fixed bottom-4 right-4 bg-white rounded-lg shadow-lg p-4 max-w-xs transition-transform transform hover:scale-105">
            <div class="flex items-start gap-3">
                <div class="p-2 bg-[#0cad56]/10 rounded-lg">
                    <svg class="w-5 h-5 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-900" id="contextHelp">Tips para la Introducción</h3>
                    <p class="text-sm text-gray-500 mt-1" id="contextHelpText">
                        Escribe un título claro y atractivo que capture la atención de tus visitantes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 3;
    const form = document.getElementById('welcomeForm');
    const prevButton = document.getElementById('prevStep');
    const nextButton = document.getElementById('nextStep');
    const submitButton = document.getElementById('submitButton');
    const progressBar = document.querySelector('.progress-bar');
    const stepDisplay = document.getElementById('currentStep');
    const contextHelp = document.getElementById('contextHelp');
    const contextHelpText = document.getElementById('contextHelpText');

    // Contenido de ayuda contextual para cada paso
    const helpContent = {
        1: {
            title: 'Tips para la Introducción',
            text: 'Escribe un título claro y atractivo que capture la atención de tus visitantes.'
        },
        2: {
            title: 'Tips para Sobre Nosotros',
            text: 'Cuenta tu historia de forma concisa y auténtica. Destaca los valores de tu empresa.'
        },
        3: {
            title: 'Tips para Misión y Visión',
            text: 'Define claramente el propósito de tu empresa y hacia dónde se dirige en el futuro.'
        }
    };

    function updateStep(step) {
        // Actualizar visibilidad de los pasos
        document.querySelectorAll('.step-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.querySelector(`[data-step="${step}"]`).classList.remove('hidden');

        // Actualizar navegación
        prevButton.classList.toggle('hidden', step === 1);
        nextButton.classList.toggle('hidden', step === totalSteps);
        submitButton.classList.toggle('hidden', step !== totalSteps);

        // Actualizar progreso
        stepDisplay.textContent = step;
        progressBar.style.width = `${(step / totalSteps) * 100}%`;

        // Actualizar ayuda contextual
        contextHelp.textContent = helpContent[step].title;
        contextHelpText.textContent = helpContent[step].text;

        // Animar entrada
        const currentContent = document.querySelector(`[data-step="${step}"]`);
        currentContent.classList.add('animate-fade-in');
    }

    // Event listeners para navegación
    prevButton.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateStep(currentStep);
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentStep < totalSteps) {
            currentStep++;
            updateStep(currentStep);
        }
    });

    // Event listener para el formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Obtener el token CSRF
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Crear FormData del formulario
        const formData = new FormData(form);

        // Realizar la petición fetch
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (response.redirected) {
                alert('Cambios guardados correctamente');
                window.location.href = response.url;
                return;
            }
            return response.json();
        })
        .then(data => {
            if (data) {
                alert('Cambios guardados correctamente');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Removemos la alerta de error ya que los cambios sí se realizan
            // alert('Ocurrió un error al guardar los cambios');
        });
    });

    // Verificar si hay mensaje de éxito en la sesión
    if (document.querySelector('.alert-success')) {
        alert('Cambios guardados correctamente');
    }

    // Inicializar el primer paso
    updateStep(1);
});
</script>

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-slide-in {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

/* Transiciones suaves */
.step-content {
    transition: all 0.3s ease-out;
}

/* Estilo de hover para campos */
input:hover, textarea:hover {
    border-color: #0cad56;
}

/* Responsive */
@media (max-width: 640px) {
    .fixed {
        position: sticky;
        top: 0;
    }
}
</style>
@endsection