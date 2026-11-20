<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\StockItem;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = Supplier::factory()->count(6)->create();

        $scannersCategory = Category::create([
            'name' => 'Сканери та термінали',
            'slug' => 'scanners-terminals',
            'description' => 'Обладнання для зчитування штрихкодів та обліку на складі',
        ]);

        $item1 = $scannersCategory->stockItems()->create([
            'sku' => 'SKU-1001',
            'title' => 'Сканер штрихкодів Datalogic',
            'quantity' => 15,
            'location_zone' => 'Zone-A1',
            'is_active' => true,
        ]);
        $item1->suppliers()->attach($suppliers->random(2)->pluck('id'));

        $item2 = $scannersCategory->stockItems()->create([
            'sku' => 'SKU-1002',
            'title' => 'Термінал збору даних Zebra',
            'quantity' => 8,
            'location_zone' => 'Zone-B2',
            'is_active' => true,
        ]);
        $item2->suppliers()->attach($suppliers->random(2)->pluck('id'));

        $item3 = $scannersCategory->stockItems()->create([
            'sku' => 'SKU-1003',
            'title' => 'Принтер етикеток Xprinter',
            'quantity' => 3,
            'location_zone' => 'Zone-C3',
            'is_active' => true,
        ]);
        $item3->suppliers()->attach($suppliers->random(2)->pluck('id'));

        Category::factory()
            ->count(4)
            ->has(
                StockItem::factory()
                    ->count(5)
                    ->hasAttached($suppliers->random(2))
            )
            ->create();
    }
}
