<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    // Permitimos la asignación masiva de estos campos
    protected $fillable = ['name', 'email', 'course_id'];

    /**
     * Obtener el curso al que pertenece el estudiante.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}