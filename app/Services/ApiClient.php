<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    private const INCOMES_ENDPOINT = '/api/incomes';
    private const ORDERS_ENDPOINT  = '/api/orders';
    private const SALES_ENDPOINT   = '/api/sales';
    private const STOCKS_ENDPOINT  = '/api/stocks';

    private const LIMIT = 500;

    private string $baseUrl;
    private string $key;

    private int $requestCount = 0;
    private int $logEvery = 1;

    public function __construct()
    {
        $this->baseUrl = config('services.external_api.base_url');
        $this->key = config('services.external_api.key');
    }

    public function getIncomes(array $query = []): array
    {
        return $this->get(self::INCOMES_ENDPOINT, $query);
    }

    public function getOrders(array $query = []): array
    {
        return $this->get(self::ORDERS_ENDPOINT, $query);
    }

    public function getSales(array $query = []): array
    {
        return $this->get(self::SALES_ENDPOINT, $query);
    }

    public function getStocks(array $query = []): array
    {
        return $this->get(self::STOCKS_ENDPOINT, $query);
    }

    private function get(string $endpoint, array $query): array
    {
        $this->requestCount++;

        $query = array_merge([
            'key' => $this->key,
            'limit' => self::LIMIT,
        ], $query);

        $url = rtrim($this->baseUrl, '/') . $endpoint . '?' . http_build_query($query);

        if ($this->requestCount % $this->logEvery === 0) {
            dump("API REQUEST #{$this->requestCount}: $url");
        }

        return Http::baseUrl($this->baseUrl)
            ->acceptJson()
            ->timeout(30)
            ->retry(3, 1000)
            ->get($endpoint, $query)
            ->throw()
            ->json();
    }
}