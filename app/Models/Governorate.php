<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $fillable = ['name'];

    // Define the relationship with incidents
    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }
}
