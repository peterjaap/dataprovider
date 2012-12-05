<?php
require_once 'Dataprovider.class.php';

$d = new Dataprovider('95107811d57655a0590510235aeb54e7');

/*
print_r($d->hostname('www.elgentos.nl'));
print_r($d->phone('0507001320'));
print_r($d->chamberofcommerce('53762290'));
print_r($d->tax('NL851007181B01')); // returns nothing
*/
var_dump($d->zipcode('9723ZA','292'));
