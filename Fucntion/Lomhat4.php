<?php
function getGrade(float $s): string {
    if ($s >= 80) return "A";
    if ($s >= 70) return "B";
    return "F";
}

$students = [
    ["name" => "Jennie","gender" => "Female", "score" => 85.8],
    ["name" => "Jisoo","gender" => "Female", "score" => 75.3],
    ["name" => "Ohyul","gender" => "Male", "score" => 50.2]
];
foreach ($students as $st) {
    echo "Name: {$st['name']} | Gender: {$st['gender']} | Grade: " . getGrade($st['score']) . "<br>";
}
?>