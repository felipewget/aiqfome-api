<?php

namespace App\Http\Requests;

class StoreProductFavoriteRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'store_api_id' => 'required|integer|min:1'
        ];
    }
}
