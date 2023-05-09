<?php
function printMortgagePayments($interestRate,$propertyCost,$downPayment,$loanTerm){
    $monthlyInterestRate = $interestRate / 12;
    $totalRate = (1 + $monthlyInterestRate) ** $loanTerm;
    $loanAmount = $propertyCost-$downPayment;
    $monthlyPayment = round($loanAmount * $monthlyInterestRate * $totalRate / ($totalRate - 1), 0);
    $paymentSchedule =[];
    for ($i = 0; $i < $loanTerm; $i++){
        $interest = round($loanAmount*$monthlyInterestRate,0);
        $principal = $monthlyPayment - $interest;
        $loanAmount-=$principal;

        $paymentSchedule[$i+1] = [ 
            "basicPay" => $principal, 
            "loanPay" => $interest, 
            "balance" => $loanAmount
        ];
    }
    return $paymentSchedule;
}
$interestRate = (float)readline("Годовая ставка: ");
$propertyCost = (float)readline("Стоимость недвижимости: ");
$downPayment = (float)readline("Размер первоначального взноса: ");
$loanTerm = (int)readline("Cрок ипотеки в месяцах: ");
print_r(printMortgagePayments($interestRate,$propertyCost,$downPayment,$loanTerm));

?>
