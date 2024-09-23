<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_time', 'end_time', 'duration',
    ];

    // Relación: un examen tiene muchas preguntas
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relación: un examen tiene muchas respuestas de usuarios
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
