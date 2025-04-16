<?php

class OrderService
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function placeOrder(Order $order)
    {
        $this->paymentService->processPayment(new Payment());
        echo "Payment proccessed.... \n";
    }
}