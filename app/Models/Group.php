<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'prof_subjects', 'group_id', 'subject_id');
    }

}
