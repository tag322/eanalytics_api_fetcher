<?php

namespace App\Services;

use App\Services\ApiClient;
use Carbon\Carbon;

use App\Models\Income;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Stock;

class SyncService {
    private const PAGES_TO_FETCH = 10;

    public function __construct(
        private ApiClient $api,
    ) {}

    public function sync(string $entity = 'all'): void
    {
        $query = [
            'dateFrom' => config('services.external_api.test_mode') ?? false ? Carbon::now()->format('Y-m-d') : '2020-01-01',
            'dateTo' => Carbon::now()->format('Y-m-d'),
        ];

        if ($entity === 'all' || $entity === 'incomes') {
                $this->syncEntity(
                    fn ($page) => $this->api->getIncomes(array_merge($query, ['page' => $page])),
                    Income::class,
                    ['income_id'],
                );
            }

        if ($entity === 'all' || $entity === 'orders') {
            $this->syncEntity(
                fn ($page) => $this->api->getOrders(array_merge($query, ['page' => $page])),
                Order::class,
                ['g_number'],
            );
        }

        if ($entity === 'all' || $entity === 'sales') {
            $this->syncEntity(
                fn ($page) => $this->api->getSales(array_merge($query, ['page' => $page])),
                Sale::class,
                ['g_number'],
            );
        }

        if ($entity === 'all' || $entity === 'stocks') {
            $stocksQuery = $query;
            $stocksQuery['dateFrom'] = $stocksQuery['dateTo'];

            $this->syncEntity(
                fn ($page) => $this->api->getStocks(array_merge($stocksQuery, ['page' => $page])),
                Stock::class,
                ['g_number'],
            );
        }
    }

    private function syncEntity(
        \Closure $fetcher,
        string $model,
        array $uniqueBy,
    ): void
    {
        foreach ($this->fetch($fetcher) as $row) {
            $model::upsert(
                [$row],
                $uniqueBy
            );
        }
    }

    private function fetch(\Closure $fetcher): \Generator
    {
        $page = 1;
        $lastPage = null;

        do {
            $response = $fetcher($page);

            $rows = $response['data'] ?? [];
            $meta = $response['meta'] ?? [];

            $lastPage = $meta['last_page'] ?? $page;

            foreach ($rows as $row) {
                yield $row;
            }

            $page++;

        } while ($page <= $lastPage);
    }
}