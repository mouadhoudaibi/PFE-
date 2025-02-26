<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name','coefficient'];

    public function profs()
    {
        return $this->belongsToMany(Prof::class, 'prof_subjects');
    }

    // app/Models/Subject.php

public function groups()
{
    return $this->belongsToMany(Group::class, 'prof_subjects', 'subject_id', 'group_id');
}

}
