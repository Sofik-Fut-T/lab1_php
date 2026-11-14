<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StockItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sku',
        'title',
        'quantity',
        'location_zone',
        'is_active',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Зв'язок Many-to-One — товар належить до певної категорії.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Зв'язок M:M — товар постачається кількома постачальниками через таблицю stock_item_supplier.
     */
    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class)->withTimestamps();
    }
}
