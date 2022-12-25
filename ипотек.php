function mortgagePayment($principal, $interestRate, $termMonths, $monthsPaid) {
  // рассчитываем месячную процентную ставку
  $monthlyInterestRate = $interestRate / 12;
  // рассчитываем аннуитетный платеж
  $payment = $principal * $monthlyInterestRate / (1 - pow(1 + $monthlyInterestRate, -$termMonths));
  // рассчитываем остаток задолженности после $monthsPaid месяцев
  $remainingBalance = $principal * pow(1 + $monthlyInterestRate, $monthsPaid) - $payment * ((pow(1 + $monthlyInterestRate, $monthsPaid) - 1) / $monthlyInterestRate);
 
