<?php
declare(strict_types=1);
function calcAverage(float $m1, float $m2, float $m3): float {
    return ($m1 + $m2 + $m3) / 3;
}
$avg = calcAverage(85.0, 90.0, 88.0);
echo "Average: " . round($avg, 2);
?>