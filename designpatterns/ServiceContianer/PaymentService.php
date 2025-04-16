<?php

declare(strict_types=1);

interface PaymentService
{
    public function processPayment(Payment $payment);
}