<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Ver todos los cursos (GET)
    public function index()
    {
        return Course::all();
    }

    // Crear un curso (POST)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        return Course::create($validated);
    }

    // Ver un curso específico (GET)
    public function show(Course $course)
    {
        return $course;
    }

    // Actualizar un curso (PUT)
    public function update(Request $request, Course $course)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string' // Aquí puedes dejarlo required o nullable según prefieras
    ]);

    $course->update($validated);
    return response()->json($course);
    }

    // Eliminar un curso (DELETE)
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->noContent();
    }
}