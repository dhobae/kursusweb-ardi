<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kursus extends Model
{
    use HasFactory;

    protected $table = 'kursus';
    protected $guarded = ['id'];

    public function materis() : HasMany
    {
        return $this->hasMany(Materi::class);
    }
}
