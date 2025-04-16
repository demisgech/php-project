<?php

declare(strict_types=1);

class TelebirrPaymentService implements PaymentService
{
    public function processPayment(Payment $payment)
    {
        echo "***** TELEBIRR PAYMENT SERVICE ****\n";
    }
}