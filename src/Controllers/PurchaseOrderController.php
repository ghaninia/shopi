<?php

namespace Shopi\Controllers;

use Shopi\Models\Product;
use Shopi\Models\User;
use Shopi\Resource\RestResponse;
use Shopi\UseCase\ProcessBaseOrderHandler;
use Shopi\UseCase\StockAvailabilityHandler;
use Shopi\UseCase\WalletBalanceHandler;
use const Shopi\Resource\HTTP_BAD_REQUEST;
use const Shopi\Resource\HTTP_OK;

class PurchaseOrderController extends AbstractController
{
    public function init(int $productId)
    {
        $quantity = $this->request->getParams()->get("quantity");
        $userId = (int)$this->request->getHeaders()->get("user-id");


        try {

            $this->db->action(function ($db) use ($userId, $productId, $quantity) {
                $product = (new Product($db))->getProductById($productId);
                $user = (new User($db))->getUserById($userId);

                $walletBalanceHandler = new WalletBalanceHandler($db, $this->log);
                $stockAvailabilityHandler = new StockAvailabilityHandler($db, $this->log);
                $processOrderHandler = new ProcessBaseOrderHandler($db, $this->log);

                $walletBalanceHandler->setNextHandler($stockAvailabilityHandler);
                $stockAvailabilityHandler->setNextHandler($processOrderHandler);

                $walletBalanceHandler->handleOrder($user, $product, $quantity);
            });

            (new RestResponse(HTTP_OK))
                ->message("the purchase order has been successfully placed.")->echo();

        } catch (\Throwable $exception) {

            $this->log->critical($exception->getMessage());
            (new RestResponse(HTTP_BAD_REQUEST))
                ->message($exception->getMessage())->echo();
        }
    }
}