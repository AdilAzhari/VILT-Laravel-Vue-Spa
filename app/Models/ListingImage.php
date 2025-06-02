<?php

namespace App\Models;

use Database\Factories\ListingImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    /** @use HasFactory<ListingImageFactory> */
    use HasFactory;

    protected $fillable = ['filename'];

    protected $appends = ['src'];

    /**
     * Get the listing that owns the ListingImage
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    // getRealSrcAttribute -> real_src
    public function getSrcAttribute(): string
    {
        return asset("storage/$this->filename");
    }
}
