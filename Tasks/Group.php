<?php

declare(strict_types=1);

namespace App\Tasks;

class Group
{
    /** @var Student[] */
    private array $students = [];

    public function __construct(
        public int $groupId,
        public string $name
    ) {}

    public function addStudent(Student $student): void
    {
        $this->students[$student->id] = $student;
    }

    public function removeStudent(int $id): void
    {
        unset($this->students[$id]);
    }

    public function searchStudent(string $query): array
    {
        return array_filter(
            $this->students,
            fn (Student $s) => stripos($s->name, $query) !== false || stripos($s->surname, $query) !== false
        );
    }

    public function getStudents(): array
    {
        return $this->students;
    }
}
