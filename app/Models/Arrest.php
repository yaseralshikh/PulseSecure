<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arrest extends Model
{
    use HasFactory;
    
    protected $fillable = ['incident_id', 'person_name', 'category', 'date'];
    
    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }

}
