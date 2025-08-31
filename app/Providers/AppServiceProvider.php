<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Integrations\StoreApi\StoreApiClient;
use App\Integrations\StoreApi\Apis\FakeStoreApi;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StoreApiClient::class, function ($app) {
            $api = $app->make(FakeStoreApi::class);

            return new StoreApiClient($api);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
