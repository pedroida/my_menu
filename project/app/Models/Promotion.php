<?php

namespace App\Models;

use App\Enums\PromotionTypeEnum;
use App\Scopes\SearchScope;
use Carbon\Carbon;
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
    protected $searchByRelationship = [
        'products' => ['name']
    ];

    protected $fillable = ['name', 'type', 'valid_from', 'valid_until', 'value'];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function setValidFromAttribute($value)
    {
        return $this->attributes['valid_from'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setValidUntilAttribute($value)
    {
        return $this->attributes['valid_until'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setValueAttribute($value)
    {
        if($this->isValueToDiscount()) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
            $value = floatval($value) * 100;
        }

        return $this->attributes['value'] = $value;
    }

    public function getFormattedValueAttribute()
    {
        if($this->isValueToDiscount()) {
            return "R$" . number_format($this->attributes['value'] / 100, '2', ',', '.');
        }

        return $this->attributes['value'] . "%";
    }

    public function getValueToCalculate()
    {
        return ($this->isValueToDiscount()) ? $this->attributes['value'] / 100 : $this->attributes['value'];
    }

    public function isValueToDiscount()
    {
        return $this->attributes['type'] === PromotionTypeEnum::VALUE_TO_DISCOUNT;
    }

    public function getIsActiveAttribute()
    {
        return now()->between($this->valid_from->startOfDay(), $this->valid_until->endOfDay());
    }
}
