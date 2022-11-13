<?php

declare(strict_types=1);

use App\GenTools\tNail as mk;

include 'vendor/autoload.php';

$m = new mk;
$m->generate('st_cosmas_and_st_damian_church.jpg', 1280, 640, 'petzen_kirche_thb.png');
