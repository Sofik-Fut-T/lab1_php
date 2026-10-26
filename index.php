<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use App\Core\Database;
use App\Core\EntityFactory;
use App\Services\ConsoleLogger;
use App\Services\EntityService;
use App\Tasks\Exam;
use App\Tasks\FinalExam;
use App\Tasks\Group;
use App\Tasks\Rectangle;
use App\Tasks\Student;
use App\Tasks\TestTrial;

echo "=== 1. Патерн Singleton ===\n";
$db = Database::getInstance();

echo "\n=== 2. Патерн Factory ===\n";
$user = EntityFactory::createEntity('user', [
    'name' => 'Софія',
    'email' => 'sofia@example.com',
]);
$product = EntityFactory::createEntity('product', [
    'name' => 'Ноутбук',
    'price' => 32000.0,
]);

echo $user->getDetails()."\n";
echo $product->getDetails()."\n";

echo "\n=== 3. Трейт (JSON Export) ===\n";
if (method_exists($user, 'exportToJson')) {
    echo $user->exportToJson()."\n";
}

echo "\n=== 4. Dependency Injection & Logger ===\n";
$logger = new ConsoleLogger;
$service = new EntityService($logger);
$service->processEntity($product);

echo "\n=== 5. Індивідуальні завдання (Варіант 1) ===\n";

// Таблиця 4.2: Студенти та групи
$group = new Group(101, 'ІПЗ-21');
$s1 = new Student(1, 'Іван', 'Петренко', '2003-05-12');
$s2 = new Student(2, 'Олена', 'Ковальчук', '2004-01-20');
$group->addStudent($s1);
$group->addStudent($s2);

echo "Група {$group->name}: студентів усього ".count($group->getStudents())."\n";

// Таблиця 4.3: Ієрархія випробувань
$test = new TestTrial('Модуль 1');
$exam = new Exam('Семестровий іспит');
$finalExam = new FinalExam('Державний іспит');

echo 'Прохідний бал (Тест): '.$test->getPassingScore()."\n";
echo 'Прохідний бал (Іспит): '.$exam->getPassingScore()."\n";
echo 'Прохідний бал (Випускний іспит): '.$finalExam->getPassingScore()."\n";

// Таблиця 4.4: Прямокутник
$rect = new Rectangle(6.0, 8.0);
echo "Прямокутник {$rect->width}x{$rect->height} -> Периметр: ".$rect->getPerimeter().', Площа: '.$rect->getArea()."\n";
