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

    public function getCompoundNameAttribute()
    {
        return $this->name . ' (' . $this->category->name . '/' . $this->unit->name . ')';
    }

    public function getThumbnailAttribute()
    {
        $path = $this->getFirstMediaUrl('image', 'thumbnail');
        return Storage::get($path);
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('image');
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
