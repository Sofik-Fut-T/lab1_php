<?php
$categories = ['Smartphones', 'Laptops', 'Tablets', 'Accessories', 'Monitors'];
sort($categories);

$product = [
    'id' => 1,
    'name' => 'MacBook Pro 16',
    'price' => 2500.00,
    'in_stock' => true,
    'category' => 'Laptops'
];

echo "<ul>";
foreach ($categories as $cat) echo "<li>$cat</li>";
echo "</ul><ul>";
foreach ($product as $key => $val) echo "<li>$key: $val</li>";
echo "</ul>";