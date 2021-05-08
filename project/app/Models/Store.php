<?php

namespace App\Models;

use App\Scopes\SearchScope;
use App\Traits\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Store extends Model implements HasMedia
{
    use SearchScope;
    use HasMediaTrait;

    protected $table = 'store';

    protected $fillable = ['whatsapp'];

    public function registerMediaCollections()
    {
        $imageAcceptedMimes = collect([
            'image/jpeg',
            'image/jpg',
            'image/png',
        ]);

        $this->addMediaCollection('banner')
            ->singleFile()
            ->acceptsFile(function (File $file) use ($imageAcceptedMimes) {
                return $imageAcceptedMimes->contains($file->mimeType);
            });
    }

    public function getBannerAttribute()
    {
        $media = $this->getFirstMedia('banner');
        return Storage::disk('local')->get($media->id . '/' . $media->file_name);
    }
}
