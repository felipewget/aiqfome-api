<?php

namespace App\Integrations\StoreApi;

abstract class AbstractApi {
    abstract function getProducts(): array;

    abstract function getProductById(string $id): ?array;

    abstract protected function getBaseUrl(): string;
}