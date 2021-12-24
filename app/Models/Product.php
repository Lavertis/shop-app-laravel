<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
    ];

    public function getPriceAsDecimal(): string
    {
        $price = $this->getAttribute('price');
        if (!strpos($price, '.'))
            $price .= '.00';
        return $price;
    }

    public function baskets(): BelongsToMany
    {
        return $this->belongsToMany(Basket::class);
    }
}
