<?php
function GetLoanPayments($rate, $sum, $initialPayment, $period){
    $loanSum = $sum-$initialPayment;
    $monthlyRate = $rate / 12;
    $totalRate = (1 + $monthlyRate) ** $period;
    $monthlyPayment = round($loanSum * $monthlyRate * $totalRate / ($totalRate - 1), 2);
    $paymentsByMonth =[];
    for ($i = 0; $i< $period; $i++){
        $interestPayment = round($loanSum*$monthlyRate,2);
        $basicPayment = $monthlyPayment - $interestPayment;
        $loanSum-=$basicPayment;
        $paymentsByMonth[$i+1] = [ "basicPayment" => $basicPayment, "loanPayment" => $interestPayment, "balance" => $loanSum];
    }
    return $paymentsByMonth;
}
?>