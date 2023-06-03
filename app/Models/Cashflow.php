<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cashflow extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['Acount'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function Acount()
    {
        return $this->belongsTo(Acount::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function image(): MorphOne
    {
        return $this->MorphOne(Image::class, 'imageable');
    }
}
