<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer',
    ];

    // Relación: una pregunta pertenece a un examen
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    // Relación: una pregunta tiene muchas respuestas de usuarios
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
