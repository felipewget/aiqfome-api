<?php

namespace App\Http\Controllers;

use App\Integrations\StoreApi\StoreApiClient;

/**
 * Controller responsável por gerenciar produtos via Store API
 */
class ProductController extends Permissions
{
    /**
     * constructor.
     *
     * @param StoreApiClient $storeApi contain o client da API de produtos da loja
     */
    public function __construct(protected StoreApiClient $storeApi){}

    /**
     * Lista todos os produtos.
     *
     * @return array Retorna um array de produtos.
     */
    public function index()
    {
        return $this->storeApi->getProducts();
    }

    /**
     * Mostra os detalhes de um produto específico.
     *
     * @param string $productId ID do produto.
     * @return array Retorna os dados do produto.
     */
    public function show(string $productId)
    {
        return $this->storeApi->getProductById($productId);
    }    
}
