<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Airport extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'code', 'latitude', 'longitude', 'country_id'];

    public function toSearchableArray()
    {
        return [
            'id' => $this->getKey(),
            'country_id' => $this->country_id,
            'name' => $this->name,
            'code' => $this->code,
            '_geo' => [
                'lat' => (float) $this->latitude,
                'lng' => (float) $this->longitude,
            ],
        ];
    }
}
