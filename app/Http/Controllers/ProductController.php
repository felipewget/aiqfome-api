<?php

namespace App\Http\Controllers;

use App\Integrations\StoreApi\StoreApiClient;

class ProductController extends Controller
{
    public function __construct(protected StoreApiClient $storeApi){}

    public function index()
    {
        return $this->storeApi->getProducts();
    }

    public function show(string $productId)
    {
        return $this->storeApi->getProductById($productId);
    }
}
