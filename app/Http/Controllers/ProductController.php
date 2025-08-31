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
    public function __construct(protected StoreApiClient $storeApi) {}

    /**
     * Lista todos os produtos.
     *
     * @return array Retorna um array de produtos.
     * @response 200 [
     * [
     * {
     *    "id": 1,
     *    "title": "Fjallraven - Foldsack No. 1 Backpack, Fits 15 Laptops",
     *    "price": 109.95,
     *    "description": "Your perfect pack for everyday use and walks in the forest. Stash your laptop (up to 15 inches) in the padded sleeve, your everyday",
     *    "category": "men's clothing",
     *    "image": "https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_t.png",
     *    "rating": {
     *        "rate": 3.9,
     *        "count": 120
     *    }
     * },
     * ]
     * @unauthenticated
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
     * @response 200  {
     *    "id": 1,
     *    "title": "Fjallraven - Foldsack No. 1 Backpack, Fits 15 Laptops",
     *    "price": 109.95,
     *    "description": "Your perfect pack for everyday use and walks in the forest. Stash your laptop (up to 15 inches) in the padded sleeve, your everyday",
     *    "category": "men's clothing",
     *    "image": "https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_t.png",
     *    "rating": {
     *        "rate": 3.9,
     *        "count": 120
     *    }
     * }
     * @unauthenticated
     * @urlParam productId required Product ID. Example: 1
     */
    public function show(string $productId)
    {
        return $this->storeApi->getProductById($productId);
    }
}
