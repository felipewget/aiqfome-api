<?php

namespace App\Services;

use App\Helpers\MoneyHelper;
use App\Integrations\StoreApi\StoreApiClient;
use App\Models\User;
use App\Models\Product;
use Exception;
use Illuminate\Support\Collection;

/**
 * Serviço responsável por gerenciar os produtos favoritos de um usuário
 */
class ProductFavoritesService
{
    protected User $user;
    protected StoreApiClient $storeApi;

    /**
     * Construtor
     *
     * @param User $user Usuario(tipo cliente) que tem a lista de favoritos
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->storeApi = app()->make(StoreApiClient::class);
    }

    /**
     * Lista todos os produtos favoritos do cliente
     *
     * @return Collection Coleção de produtos favoritos
     */
    public function listProducts(): Collection
    {
        return $this->user->favoriteProducts()->get();
    }

    /**
     * Adiciona um produto para a lista de favoritos do client
     *
     * @param string $apiProductId ID do produto na API externa
     * @throws Exception Se o produto não for encontrado ou já estiver nos favoritos
     * @return bool Retorna true se adicionado com sucesso
     */
    public function addProduct($apiProductId): bool
    {
        $apiProduct = $this->storeApi->getProductById($apiProductId);

        if (! $apiProduct) {
            throw new Exception("Product {$apiProductId} not found by store api");
        }

        if ($this->has($apiProductId)) {
            throw new Exception("This product is added on your favorites already");
        }

        $product = Product::updateOrCreate(
            ['store_api_id' => $apiProductId],
            [
                'store_api_id' => $apiProductId,
                'title' => $apiProduct['title'],
                'image' => $apiProduct['image'],
                'price' => MoneyHelper::floatToString($apiProduct['price']),
                'review' => $apiProduct['rating'],
            ]
        );

        return $this->user->favoriteProducts()->attach($product->id) ?? false;
    }

    /**
     * Remove um produto da lista de favoritos do cliente
     *
     * @param string $apiProductId ID do produto na API externa
     * @throws Exception Se o produto não estiver nos favoritos
     * @return bool Retorna true se removido com sucesso.
     */
    public function removeProduct($apiProductId): bool
    {
        $product = $this->user->favoriteProducts()->where(['store_api_id' => $apiProductId])->first();

        if(!$product){
            throw new Exception("This product is not on your favorites already");
        }

        $this->user->favoriteProducts()->detach($product->id);

        return true;
    }

    /**
     * Verifica se um produto já está nos favoritos do cliente
     *
     * @param string $apiProductId ID do produto na API externa.
     * @return bool True se o produto já estiver nos favoritos.
     */
    private function has($apiProductId): bool
    {
        return $this->user->favoriteProducts()->where('store_api_id', $apiProductId)->exists();
    }
}
