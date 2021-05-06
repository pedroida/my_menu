<?php

namespace App\Models;

use App\Enums\PromotionTypeEnum;
use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;
    use SearchScope;
    use HasFactory;

    protected $table = 'promotions';

    protected $searchBy = ['name', 'valid_from', 'valid_until', 'value'];
    protected $searchByRelationship = ['products.name'];

    protected $fillable = ['name', 'type', 'valid_from', 'valid_until', 'value'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function setValueAttribute($value)
    {
        if($this->attributes['type'] === PromotionTypeEnum::VALUE_TO_DISCOUNT) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
            $value = floatval($value) * 100;
        }

        return $this->attributes['value'] = $value;
    }

    public function getFormattedValueAttribute()
    {
        if($this->attributes['type'] === PromotionTypeEnum::VALUE_TO_DISCOUNT) {
            return "R$" . number_format($this->attributes['value'] / 100, '2', ',', '.');
        }

        return $this->attributes['value'] . "%";
    }
}
