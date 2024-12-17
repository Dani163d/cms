<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $noticias = [
            [
                'titulo' => 'Guía Completa: Cómo Elegir tu Carrera Universitaria',
                'extracto' => 'Descubre los pasos clave para tomar una decisión informada sobre tu futuro académico.',
                'imagen' => 'noticia1.jpg',
                'fecha' => '15 de Marzo, 2024',
                'link' => '#'
            ],
            [
                'titulo' => 'Tendencias Laborales 2024: Carreras con Mayor Demanda',
                'extracto' => 'Analizamos los campos profesionales con más oportunidades en el mercado actual.',
                'imagen' => 'noticia2.jpg',
                'fecha' => '22 de Febrero, 2024',
                'link' => '#'
            ],
            [
                'titulo' => 'Psicología Vocacional: Claves para Encontrar tu Pasión',
                'extracto' => 'Expertos comparten estrategias para descubrir tu verdadera vocación profesional.',
                'imagen' => 'noticia3.jpg',
                'fecha' => '10 de Enero, 2024',
                'link' => '#'
            ]
        ];

        // Cambia 'noticias.index' por 'noticias'
        return view('noticias', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
