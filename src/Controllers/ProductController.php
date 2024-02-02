<?php

namespace Shopi\Controllers;

use Shopi\Models\Product;
use Shopi\Resource\ProductResponse;
use Shopi\Resource\ReservedSlotResponse;
use Shopi\Resource\RestResponse;
use const Shopi\Resource\HTTP_OK;

class ProductController extends AbstractController
{
    public function list()
    {
        $products = (new Product($this->db))->list();
        (new RestResponse(HTTP_OK))
            ->payload(ProductResponse::collection($products))
            ->echo();
    }
}