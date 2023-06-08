<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Travel extends Model
{
    use HasFactory, Sluggable, HasUuids;

    protected $table = 'travels';

    protected $fillable = [
        'is_public',
        'slug',
        'name',
        'description',
        'number_of_days',
    ];

    public function tours():HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function sluggable(): array
    {
        return[
            'slug' => [
                'source' => 'name'
            ]
            ];
    }

    public function getNumberOfNightsAttribute()
    {
        return $this->number_of_days - 1;
    }
}
