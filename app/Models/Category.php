<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Зв'язок 1:М — одна категорія містить багато складських позицій.
     */
    public function stockItems(): HasMany
    {
        return $this->hasMany(StockItem::class);
    }
}
