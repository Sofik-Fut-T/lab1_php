<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'contact_email'];

    /**
     * Зв'язок M:M — постачальник постачає багато товарів на склад.
     */
    public function stockItems(): BelongsToMany
    {
        return $this->belongsToMany(StockItem::class)->withTimestamps();
    }
}
