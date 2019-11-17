<?php
require __DIR__ . '/vendor/autoload.php';

$length = 8;
$universe = new GOL\Universe($length);
$universe->setCellAlive(0, 1);
$universe->setCellAlive(3, 1);
$universe->setCellAlive(2, 1);
$universe->setCellAlive(2, 6);
$universe->setCellAlive(5, 2);
$universe->setCellAlive(7, 7);
$universe->setCellAlive(6, 7);
$universe->setCellAlive(5, 5);
$universe->setCellAlive(6, 6);
$universe->setCellAlive(4, 6);
$universe->setCellAlive(4, 4);
$universe->setCellAlive(2, 3);

while (1) {
    for ($i = 0; $i < $length; $i++) {
        echo "\n";
        for ($j = 0; $j < $length; $j++) {
            echo $universe->getCellState($i, $j) ? "X " : ". ";
        }
    }
    echo "\n";
    sleep(2);
    $universe->calculateNextState();
}
