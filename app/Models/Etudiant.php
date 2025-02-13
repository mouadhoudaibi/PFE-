<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etudiant extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'group_id'];

    protected $hidden = ['password'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
