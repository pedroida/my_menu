<?php

namespace App\Models;

use App\Scopes\SearchScope;
use App\Traits\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use SoftDeletes;
    use SearchScope;
    use HasFactory;
    use HasMediaTrait;

    protected $table = 'products';

    protected $searchBy = ['name', 'description'];

    protected $fillable = ['name', 'description', 'price', 'category_id', 'unit_id', 'promotion_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function setPriceAttribute($value)
    {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        $value = floatval($value) * 100;

        $this->attributes['price'] = $value;
    }

    public function getPriceAttribute()
    {
        return number_format($this->attributes['price'] / 100, '2', ',', '.');
    }

    public function getPromotionalPriceAttribute()
    {
        if(!$this->promotion || !$this->promotion->is_active)
            return null;

        $price = $this->attributes['price'] / 100;
        $promotionValue = $this->promotion->getValueToCalculate();

        if($this->promotion->isValueToDiscount()) {
            $price -= $promotionValue;
        } else {
            $discountValue = $price * ($promotionValue / 100);
            $price -= $discountValue;
        }

        $price = ($price >= 0) ? $price : 0;

        return number_format($price, '2', ',', '.');
    }

    public function getCompoundNameAttribute()
    {
        return $this->name . ' (' . $this->category->name . '/' . $this->unit->name . ')';
    }

    public function getThumbnailAttribute()
    {
        $media = $this->getFirstMedia('image');
        $path = Storage::disk('local')->files($media->id . '/conversions')[0];
        return Storage::disk('local')->get($path);
    }

    public function getImageAttribute()
    {
        $media = $this->getFirstMedia('image');
        return Storage::disk('local')->get($media->id . '/' . $media->file_name);
    }

    public function registerMediaCollections()
    {
        $imageAcceptedMimes = collect([
            'image/jpeg',
            'image/jpg',
            'image/png',
        ]);

        $this->addMediaCollection('image')
            ->singleFile()
            ->acceptsFile(function (File $file) use ($imageAcceptedMimes) {
                return $imageAcceptedMimes->contains($file->mimeType);
            });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(200)
            ->height(200)
            ->performOnCollections('image');
    }
}
