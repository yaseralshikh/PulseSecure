<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productivity extends Model
{
    use HasFactory;
    
    protected $fillable = ['entity_id', 'date', 'value'];

    // Define the relationship with entities
    public function entity()
    {
        return $this->belongsTo(Entitie::class);
    }
}