<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entitie extends Model
{
    protected $fillable = ['name'];

    // Define the relationship with incidents
    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    // Define the relationship with productivities
    public function productivities()
    {
        return $this->hasMany(Productivity::class);
    }
}
