<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfSubject extends Model
{
    use HasFactory;

    protected $fillable = ['prof_id', 'subject_id', 'group_id'];

    public function prof()
    {
        return $this->belongsTo(Prof::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
