<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Creamos un curso de prueba
    $curso = \App\Models\Course::create([
        'name' => 'Desarrollo Web Fullstack',
        'description' => 'Curso de Vue y Laravel'
    ]);

    // Creamos un estudiante asociado a ese curso
    \App\Models\Student::create([
        'name' => 'Estudiante de Prueba',
        'email' => 'prueba@ejemplo.com',
        'course_id' => $curso->id
    ]);
}
}
