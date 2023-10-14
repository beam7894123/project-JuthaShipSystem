<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Journey extends Model
{
    use HasFactory;

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function containers(): HasMany
    {
        return $this->hasMany(Container::class);
    }

    public function ship(): HasOne
    {
        return $this->hasOne(Ship::class);
    }

    public function crews(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
