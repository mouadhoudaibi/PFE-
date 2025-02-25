<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['etudiant_id', 'prof_id', 'subject_id', 'grade', 'grade2'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function prof()
    {
        return $this->belongsTo(Prof::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
