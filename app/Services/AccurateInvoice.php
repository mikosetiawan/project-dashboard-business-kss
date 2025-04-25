<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AccurateInvoice
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    function getListInvoice(string $host, string $accessToken, string $dbSession): array
    {
        $currentMonth = date('n');

        $endpoint = '/accurate/api/sales-invoice/list.do';

        $hitAPI = Http::withHeaders([
            'X-Session-ID' => $dbSession,
            'Authorization' => 'Bearer ' . $accessToken
        ])->get($host . $endpoint, [
            'filter.dueDate.op' => 'BETWEEN',
            'filter.dueDate.val[0]' => Carbon::createFromDate(2025, $currentMonth)->startOfMonth()->format('d/m/Y'),
            'filter.dueDate.val[1]' => Carbon::createFromDate(2025, $currentMonth)->endOfMonth()->format('d/m/Y'),
            'fields' => 'totalAmount'
        ]);

        if ($hitAPI->successful()) {
            return $hitAPI->json();
        }

        return ['error' => $hitAPI->body()];
    }
}
