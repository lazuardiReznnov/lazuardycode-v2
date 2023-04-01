<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class acountFintech extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image(): MorphOne
    {
        return $this->MorphOne(Image::class, 'imageable');
    }

    public function fintech()
    {
        return $this->belongsTo(fintech::class);
    }

    public function Debt()
    {
        return $this->hasOne(Debt::class);
    }
}
