<?php

declare(strict_types=1);

spl_autoload_register(function ($className) {
    $path = __DIR__ . "/" . str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
    if (file_exists($path))
        require_once $path;
    else
        die("$className is not found!!!");
});

// Let's try the beauti of Service Container design pattern and Dependency Injection principle

/**
 * Dependency Injection is a design principle where:
 * A class receives its dependencies from the outside instead of creating them itself.
 *
 * Service Container is a design pattern/tool that:
 * Manages the construction of classes and their dependencies, automatically injecting them when needed.
 * It automates the process of Dependency Injection, often using reflection.
 */

$container = new Container();

$container->bind(Logger::class, FileLogger::class);

$userService = $container->make(UserService::class);

$userService->createUser("Demis");
$userService->createUser("Abebe");


$container->bind(PaymentService::class, StripePaymentService::class);
$orderService = $container->make(OrderService::class);
$orderService->placeOrder(new Order());

$container->bind(PaymentService::class, PayPalPaymentService::class);
$orderService = $container->make(OrderService::class);
$orderService->placeOrder(new Order());

$container->bind(PaymentService::class, TelebirrPaymentService::class);
$orderService = $container->make(OrderService::class);
$orderService->placeOrder(new Order());



