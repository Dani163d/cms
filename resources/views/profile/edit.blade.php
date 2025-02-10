<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#FFE4D6] to-[#FFF5F0] rounded-lg py-3 px-4">
            <h2 class="font-bold text-2xl text-[#FF7F50] leading-tight">
                {{ __('Mi Perfil') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-white to-[#FFF5F0]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Información del Perfil -->
            <div class="p-6 sm:p-8 bg-white shadow-lg sm:rounded-xl border border-[#FFE4D6] transform hover:scale-[1.01] transition-all duration-300">
                <div class="max-w-xl">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-[#FFE4D6] p-2 rounded-lg">
                            <svg class="w-5 h-5 text-[#FF7F50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-[#FF7F50]">
                            Información del Perfil
                        </h3>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Actualizar Contraseña -->
            <div class="p-6 sm:p-8 bg-white shadow-lg sm:rounded-xl border border-[#FFE4D6] transform hover:scale-[1.01] transition-all duration-300">
                <div class="max-w-xl">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-[#FFE4D6] p-2 rounded-lg">
                            <svg class="w-5 h-5 text-[#FF7F50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-[#FF7F50]">
                            Actualizar Contraseña
                        </h3>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Eliminar Cuenta -->
            <div class="p-6 sm:p-8 bg-white shadow-lg sm:rounded-xl border border-[#FFE4D6] transform hover:scale-[1.01] transition-all duration-300">
                <div class="max-w-xl">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-[#FFE4D6] p-2 rounded-lg">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-red-500">
                            Eliminar Cuenta
                        </h3>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Animaciones y efectos */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Mejoras en inputs */
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #FF9F7D;
            box-shadow: 0 0 0 3px rgba(255, 159, 125, 0.2);
        }

        /* Efectos hover en botones */
        .btn-primary {
            @apply bg-[#FF7F50] text-white px-4 py-2 rounded-lg transition-all duration-300;
        }

        .btn-primary:hover {
            @apply bg-[#FF9F7D] transform scale-105 shadow-lg;
        }

        .btn-danger {
            @apply bg-red-500 text-white px-4 py-2 rounded-lg transition-all duration-300;
        }

        .btn-danger:hover {
            @apply bg-red-600 transform scale-105 shadow-lg;
        }

        /* Responsividad */
        @media (max-width: 640px) {
            .max-w-7xl {
                @apply px-4;
            }
        }
    </style>
</x-app-layout>