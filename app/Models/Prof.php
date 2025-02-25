<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  



class Prof extends Authenticatable  
{



    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'prof_subjects');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'prof_subjects', 'prof_id', 'group_id')->distinct();
    }

}
