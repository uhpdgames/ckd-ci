<?php

$date ='29/12/2023';
$date = strtotime(str_replace("/", "-", $date));
echo strtotime(date('Y-m-d', $date));

echo '<pre>';


echo date('d/m/Y',1703718000)
?>
