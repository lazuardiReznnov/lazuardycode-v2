<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schadule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}
