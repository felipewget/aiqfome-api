<?php

namespace App\Integrations\StoreApi\Apis;

use App\Integrations\StoreApi\AbstractApi;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FakeStoreApi extends AbstractApi
{
    const BASE_URL = 'https://fakestoreapi.com';

    public function getProducts(): array
    {
        return (Http::get($this->getBaseUrl() . "/products"))->json() ?? [];
    }

    public function getProductById(string $id): ?array
    {
        return (Http::get($this->getBaseUrl() . "/products/{$id}"))->json();
    }

    protected function getBaseUrl(): string
    {
        return self::BASE_URL;
    }
}