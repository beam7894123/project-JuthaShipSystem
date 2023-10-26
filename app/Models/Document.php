<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    public function journey(): BelongsTo
    {
        return $this->belongsTo(Journey::class);
    }

    public function deleteImage() {
        if ($this->imagePath) {
            $filename = basename($this->imagePath); // get file name from path
            Storage::disk('public')->delete('document/' . $filename); // delete image file from storage
        }
    }
}
