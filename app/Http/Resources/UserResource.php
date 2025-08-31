<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Classe reponsavel por formatar os dados de usuario que serao retornados para o client
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->getRoleNames()[0] ?? null,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
