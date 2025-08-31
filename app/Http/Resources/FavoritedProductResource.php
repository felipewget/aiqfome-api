<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Classe reponsavel por formatar os dados de produto que serao retornados para o client
 */
class FavoritedProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'external_id' => $this->store_api_id,
            'title' => $this->title,
            'image' => $this->image,
            'price' => $this->price,
            'review' => $this->rating
        ];
    }
}
