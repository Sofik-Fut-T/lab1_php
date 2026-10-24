<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Services/EntityService.php'; // Додано
require_once __DIR__ . '/app/Services/DataProcessor.php'; // Додано


use App\Services\EntityService;
use App\Services\DataProcessor;
use Faker\Factory;

echo "<h1>Лабораторна робота №3 — Варіант 1</h1>";

// --- Завдання 2 ---
echo "<h2>Завдання 2: Розрахунок замовлення</h2>";
$service = new EntityService();
$total = $service->calculateTotal(1500.50, 2);
echo "<p>Сума: <strong>{$total} грн</strong></p>";

// --- Завдання 3: Faker + Closure ---
echo "<h2>Завдання 3: Фільтрація товарів (Faker)</h2>";
$faker = Factory::create();
$prices = [];
for ($i = 0; $i < 10; $i++) {
    $prices[] = $faker->randomFloat(2, 100, 1500);
}

$minThreshold = 500.00;
$filtered = array_filter($prices, function (float $price) use ($minThreshold): bool {
    return $price > $minThreshold;
});

echo "<p><strong>Усі ціни:</strong> " . implode(', ', $prices) . "</p>";
echo "<p><strong>Ціни > {$minThreshold}:</strong> " . implode(', ', $filtered) . "</p>";

// --- Завдання 4: Try-Catch ---
echo "<h2>Завдання 4: Обробка винятків</h2>";
try {
    echo "<p>Спроба застосувати знижку 150%...</p>";
    $service->applyDiscount(1000, 150);
} catch (Exception $e) {
    echo "<p style='color:red;'><strong>Помилка:</strong> " . $e->getMessage() . "</p>";
} finally {
    echo "<p><em>Завершення спроби розрахунку.</em></p>";
}

// --- Завдання 5: Варіант 1 ---
echo "<h2>Завдання 5: Алгоритмічні задачі (Варіант 1)</h2>";
$processor = new DataProcessor();

$arr = [3, -2, 5, -1, 8];
echo "<p>1. Вставити 0 після додатних [3, -2, 5, -1, 8]: " . implode(', ', $processor->insertZeroAfterPositive($arr)) . "</p>";

$text = "ноутбук планшет екран адаптер телефон";
echo "<p>2. Кількість слів на приголосну у \"{$text}\": " . $processor->countWordsStartingWithConsonant($text) . "</p>";

$numStr = "45 120 999 15 2048 33";
echo "<p>3. Максимальне число в рядку \"{$numStr}\": " . $processor->findMaxNumberInString($numStr) . "</p>";
