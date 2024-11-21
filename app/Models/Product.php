<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;


    protected $guarded = [];


    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });

    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function getCoverAttribute()
    {
        return $this->files()->first() ? asset('storage/' . $this->files()->first()->path) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';

    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishList()
    {
        return $this->hasMany(WishList::class);
    }

    public function getRatingAttribute()
    {
        return $this->ratings->avg('rating');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }


    public function getStarsAttribute()
    {
        $rating = $this->averageRating();

        if ($rating === null) {
            return '<p class="text-sm muted">No reviews yet</p>';
        }

        $fullStars = floor($rating);
        $halfStars = ($rating - $fullStars) >= 0.5 ? 1 : 0;
        $emptyStars = 5 - ($fullStars + $halfStars);

        $starsHtml = '';

        for ($i = 0; $i < $fullStars; $i++) {
            $starsHtml .= '<i class="fa fa-star" aria-hidden="true"></i>';
        }

        for ($i = 0; $i < $halfStars; $i++) {
            $starsHtml .= '<i class="fa fa-star-half-alt" aria-hidden="true"></i>';
        }

        for ($i = 0; $i < $emptyStars; $i++) {
            $starsHtml .= '<i class="fal fa-star" aria-hidden="true"></i>';
        }

        return $starsHtml;
    }


}
