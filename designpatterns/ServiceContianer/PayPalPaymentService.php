<?php

declare(strict_types=1);

class PayPalPaymentService implements PaymentService
{

    public function processPayment(Payment $payment)
    {
        echo "******* PAYPAL PAYMENT SERVICE ****\n";
    }
}