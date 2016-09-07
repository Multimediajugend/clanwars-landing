<?php
/**
 * This code will benchmark your server to determine how high of a cost you can
 * afford. You want to set the highest cost that you can without slowing down
 * you server too much. 10 is a good baseline, and more is good if your servers
 * are fast enough.
 */
$timeTarget = 0.3; 

$cost = 4;
$best;
do {
    $cost++;
    echo "Cost ".$cost;
    $start = microtime(true);
    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
    $end = microtime(true);
    $span = $end-$start;
    echo " in " . round($span, 2) . "sec<br>";
    $best = $span < $timeTarget ? $cost : $best; 
} while ($span < 2);

echo "<br>Appropriate Cost Found: " . $best . "<br />";