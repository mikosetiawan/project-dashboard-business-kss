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

    function getTotalInvoice(string $host, string $accessToken, string $dbSession): int
    {
        $currentMonth = date('n');

        $endpoint = '/accurate/api/sales-invoice/list.do';

        $totalPage = 1;

        $getPageCount = Http::withHeaders([
            'X-Session-ID' => $dbSession,
            'Authorization' => 'Bearer ' . $accessToken
        ])->get($host . $endpoint, [
            'sp.pageSize' => 100
        ]);

        if ($getPageCount->successful()) {
            $resulPageCount = $getPageCount->json();
            $totalPage = $resulPageCount['sp']['pageCount'];
        }

        $totalInvoice = 0;

        for ($i=1; $i <= $totalPage; $i++) {
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
                $resultHitAPI = $hitAPI->json();
                foreach ($resultHitAPI['d'] as $valInvoice) {
                    $totalInvoice += $valInvoice['totalAmount'];
                }
            }
        }

        return $totalInvoice;
    }
}
