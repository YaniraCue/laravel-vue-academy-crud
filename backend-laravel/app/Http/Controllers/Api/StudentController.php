<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Cargamos el curso relacionado para mostrarlo en el frontend
        return Student::with('course')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'course_id' => 'required|exists:courses,id' // Validamos que el curso exista
        ]);

        return Student::create($validated);
    }

    public function show(Student $student)
    {
        return $student->load('course');
    }

    public function update(Request $request, Student $student)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255', // Añadido required
        'email' => 'required|email|unique:students,email,' . $student->id, // Añadido required
        'course_id' => 'required|exists:courses,id' // Añadido required
    ]);

    $student->update($validated);
    
    // Cargamos la relación para que el frontend reciba el nombre del curso actualizado
    return response()->json($student->load('course')); 
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->noContent();
    }
}