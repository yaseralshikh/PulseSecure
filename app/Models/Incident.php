<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Incident extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'entity_id', 'governorate_id', 'incident_type_id', 'incident_source_id',
        'description', 'date', 'location_lat', 'location_lng'
    ];

    // Define the relationship with Entities

    public function entity()
    {
        return $this->belongsTo(Entitie::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function type()
    {
        return $this->belongsTo(Incident_type::class, 'incident_type_id');
    }

    public function source()
    {
        return $this->belongsTo(Incident_source::class, 'incident_source_id');
    }

    public function arrests()
    {
        return $this->hasMany(Arrest::class);
    }
}
