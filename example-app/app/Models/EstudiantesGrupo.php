<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudiantesGrupo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'estudiante_grupo';
    protected $fillable = [
        'estudiante_id',
        'grupo_id',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiantes::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}
