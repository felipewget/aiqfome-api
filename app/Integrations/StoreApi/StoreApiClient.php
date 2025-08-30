<?php

namespace App\Integrations\StoreApi;

use Illuminate\Http\Client\Response;

class StoreApiClient
{
    public function __construct(protected AbstractApi $api)
    {}

    public function getProducts(): array
    {
        return $this->api->getProducts();
    }

    public function getProductById(string $id): ?array
    {
        return $this->api->getProductById($id);
    }
}