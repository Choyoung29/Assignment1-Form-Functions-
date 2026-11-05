
<?php
$prices = [100, 200, 300];
$newPrices = array_map(fn($p) => $p * 1.15, $prices);
print_r($newPrices);
?>