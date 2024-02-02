<?php

return [
    "api/products" => [
        "controller" => \Shopi\Controllers\ProductController::class,
        "method" => "list",
    ],
    "api/purchase-order/:productId" => [
        "HTTP_METHOD" => \Shopi\Core\Request::POST,
        "controller" => \Shopi\Controllers\PurchaseOrderController::class,
        "method" => "init",
        "params" => [
            "productId" => 'number'
        ]
    ],
];
