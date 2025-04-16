<?php

declare(strict_types=1);

class StripePaymentService implements PaymentService
{

    public function processPayment(Payment $payment)
    {
        echo "*****STRIPE PAYMENT SERVICE****\n";
    }
}