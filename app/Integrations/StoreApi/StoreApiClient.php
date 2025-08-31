<?php

namespace App\Integrations\StoreApi;

use Illuminate\Support\Facades\Cache;

/**
 * Cliente para integração com API externa de produtos, com cache interno
 * 
 * @internal Padrao Proxy pattern
 */
class StoreApiClient
{
    /**
     * Tempo de cache em segundos (15 minutos)
     */
    const TTL = 900;

    /**
     * Constructor
     *
     * @param AbstractApi $api Instância da API a ser utilizada.
     */
    public function __construct(protected AbstractApi $api)
    {}

    /**
     * Retorna a lista de produtos da API externa, com cache-aside pattern
     *
     * @return array Lista de produtos.
     */
    public function getProducts(): array
    {
        return Cache::remember('store_api:get_products', self::TTL, function () {
            return $this->api->getProducts();
        });
    }

    /**
     * Retorna um produto por ID, com cache-aside pattern
     *
     * @return ?array Produto da API
     */
    public function getProductById(string $id): ?array
    {
        return Cache::remember('store_api:get_product_' . $id, self::TTL, function () use ($id) {
            return $this->api->getProductById($id);
        });
    }
}