<?php
//Входные данные передаются как GET параметры веб-сервера

$persent = (float) $_GET["persent"]; // Годовая ставка
$price = (float) $_GET["price"]; // Стоимость недвижимости
$initialPayment = (float) $_GET["initialPayment"]; // Размер первоначального взноса
$period = (int) $_GET["period"]; // Срок ипотеки в месяцах

if (!isset($persent) || !isset($price) || !isset($initialPayment) || !isset($period) ||
    empty($persent) || empty($price) || empty($initialPayment) || empty($period) || $initialPayment>$price) {
        exit("Некорректно введены данные");
    }

$price = $price - $initialPayment;

$montlyPercent = $persent / 12;
$fullPercent = (1+$montlyPercent) ** $period;
$montlyPayment = $price * $montlyPercent * $fullPercent / ($fullPercent-1);
$index = 1;
$result = [];
while ($index<=$period){
    $price = $price*(1+$montlyPercent);
    $loadPayment = $price*$montlyPercent;
    $basicPayment = $montlyPayment - $loadPayment;
    $price = $price - $loadPayment - $basicPayment;
    
    $result[$index] = [
        "basicPayment"=> round($basicPayment,2),
        "loadPayment" => round($loadPayment,2),
        "balance" => round($price,2),
    ];
    $index++;
}

echo '<pre>';
print_r ($result);
echo '</pre>';


?>