<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductFavoriteRequest;
use App\Http\Resources\FavoritedProductResource;
use App\Services\ProductFavoritesService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Controller responsável por gerenciar a list de produtos favoritos do usuário tipo client.
 */
class ProductFavoriteController extends Permissions
{
    /**
     * Serviço de lista de favoritos do produto
     *
     * @var ProductFavoritesService
     */
    protected ProductFavoritesService $productFavotesService;

    /**
     * Inicializa o serviço de favoritos para o usuário autenticado.
     */
    public function __construct()
    {
        $this->productFavotesService = new ProductFavoritesService(Auth::user());
    }

    /**
     * Lista todos os produtos favoritos do cliente
     *
     * @return AnonymousResourceCollection Coleção de produtos favoritos
     */
    public function index(): AnonymousResourceCollection
    {
        $this->checkPermission('list_favorites');

        $products = $this->productFavotesService->listProducts();

        return FavoritedProductResource::collection($products);
    }

    /**
     * Adiciona um produto à lista de favoritos do cliente
     *
     * @param StoreProductFavoriteRequest $request Request contendo o ID do product na api externa pra favoritar
     * @throws \Exception Caso ocorra algum erro ao adicionar o produto
     * @return Response no content 201
     */
    public function store(StoreProductFavoriteRequest $request): Response
    {
        $this->checkPermission('add_favorites');

        $this->productFavotesService->addProduct($request->store_api_id);

        return response()->noContent(201);
    }

    /**
     * Remove um produto da lista de favoritos do cliente
     *
     * @param StoreProductFavoriteRequest $request Request contendo o ID do product na api externa pra favoritar
     * @throws \Exception Caso ocorra algum erro ao remover o produto
     * @return Response no content 204
     * @urlParam id required API Product ID. Example: 1
     */
    public function destroy($productId): Response
    {
        $this->checkPermission('remove_favorites');

        $this->productFavotesService->removeProduct($productId);

        return response()->noContent();
    }
}
