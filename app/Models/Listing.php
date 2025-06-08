<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Builder|static withTrashed()
 * @method static Builder|static onlyTrashed()
 * @method static Builder|static withoutTrashed()
 * @method Builder|static filter(array $filters)
 * @method Builder|static mostRecent()
 * @method Builder|static withoutSold()
 */
class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sold_at' => 'datetime',
    ];

    protected $fillable = [
        'beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price', 'sold_at',
    ];

    protected array $sortable = [
        'price', 'created_at',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'by_user_id'
        );
    }

    /**
     * Get the images for the listing.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    /**
     * Get the offers for the listing.
     */
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'listing_id');
    }

    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeWithoutSold(Builder $query): Builder
    {
        return $query->doesntHave('offers')
            ->orWhereHas(
                'offers',
                fn (Builder $query) => $query->whereNull('accepted_at')
                    ->whereNull('rejected_at')
            );
        //        return $query->whereNull('sold_at');
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['priceFrom'] ?? false,
            fn ($query, $value) => $query->where('price', '>=', $value)
        )->when(
            $filters['priceTo'] ?? false,
            fn ($query, $value) => $query->where('price', '<=', $value)
        )->when(
            $filters['beds'] ?? false,
            fn ($query, $value) => $query->where('beds', (int) $value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['baths'] ?? false,
            fn ($query, $value) => $query->where('baths', (int) $value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['areaFrom'] ?? false,
            fn ($query, $value) => $query->where('area', '>=', $value)
        )->when(
            $filters['areaTo'] ?? false,
            fn ($query, $value) => $query->where('area', '<=', $value)
        )->when(
            $filters['deleted'] ?? false,
            fn ($query, $value) => $query->withTrashed()
        )->when(
            $filters['by'] ?? false,
            fn ($query, $value) => in_array($value, $this->sortable)
                ? $query->orderBy($value, $filters['order'] ?? 'desc') :
                $query
        );
    }
}
